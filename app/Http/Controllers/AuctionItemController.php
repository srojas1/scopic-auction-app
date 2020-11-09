<?php

namespace App\Http\Controllers;

use App\Jobs\AutoBidUpdate;
use App\Models\AuctionItem;
use App\Models\AutoBid;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class AuctionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAuctionItems(Request $request) {
			$columns = ['id', 'title', 'description', 'price'];

			$length = $request->input('length');
			$column = $request->input('column'); //Index
			$dir = $request->input('dir');
			$searchValue = $request->input('search');

			$query = AuctionItem::select('id', 'title', 'description', 'price')->orderBy($columns[$column], $dir);

			if ($searchValue) {
				$query->where(function($query) use ($searchValue) {
					$query->where('title', 'like', '%' . $searchValue . '%')
					->orWhere('description', 'like', '%' . $searchValue . '%');
				});
			}

			$auctions = $query->paginate($length);
			return ['data' => $auctions, 'draw' => $request->input('draw')];
		}

		public function getSingleItem(Request $request) {
			$id = $request->get('id');
			$matchData = ['id' => $id];
			$columns  = ['id','title','description','price','end_date'];
			$auctionItem   = AuctionItem::where($matchData)->select($columns)->first();

			$matchDataBid = ['auction_id' => $id, 'user_id' => Auth::user()->id];

			$autoBid   = AutoBid::where($matchDataBid)->select('has_auto_bidding')->first();

			if(!empty($autoBid) && $autoBid->has_auto_bidding) {
				$autoBid = 1;
			} else {
				$autoBid = 0;
			}

			return view('detail', ['auctionItem' => $auctionItem, 'autoBidding' => $autoBid]);
		}

		public function updateBidValue(Request $request) {
			$id = $request->input('id');
			$checked = $request->input('checked');

			$matchDataBid = ['auction_id' => $id, 'user_id' => Auth::user()->id];

			$autoBid   = AutoBid::where($matchDataBid)->select('*')->first();

			if(!empty($autoBid)) {
				AutoBid::where('id', $autoBid->id)
					->update(['has_auto_bidding' => intval($checked)]);
			} else {
				$autoBid = new AutoBid();
				$autoBid->user_id  = Auth::user()->id;
				$autoBid->auction_id = $id;
				$autoBid->has_auto_bidding = intval($checked);
				$autoBid->save();
			}
		}

		public function bidItem(Request $request) {
			$id = $request->input('id');
			$price = $request->input('price');

			$auctionItem   = AuctionItem::where(['id'=> $id])->select('max_price')->first();

			$price = $price + 1;

			if($price <= $auctionItem->max_price) {
				AuctionItem::where('id', $id)
					->update(['price' => $price]);

				$bid = new Bid();
				$bid->user_id  = Auth::user()->id;
				$bid->auction_id = $id;
				$bid->price = $price;
				$bid->save();

				Artisan::call('queue:work', ['--stop-when-empty' => true]);

			} else {
				return response()->json(['error' => 'max_limit']);
			}
		}

	public function autoBidItem(Request $request) {
		$id = $request->input('id');
		$userId  = Auth::user()->id;
		AutoBidUpdate::dispatch($id, $userId);
	}
}
