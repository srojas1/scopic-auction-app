@extends('layouts.app')

@section('content')
	<item-detail :api-data="{{$auctionItem}}" :bid-data="{{$autoBidding}}"></item-detail>
@endsection
