<?php

namespace App\Jobs;

use App\Models\AuctionItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AutoBidUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $price;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
			AuctionItem::where('id', $this->id)->increment('price');
    }
}
