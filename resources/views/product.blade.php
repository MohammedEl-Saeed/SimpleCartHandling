@extends('layouts.layout')
@include('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container products">
        <div class="row">
            @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail border border-light">
                        <img src="{{ $product->photo }}" width="500" height="300">
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p class="desc-item">{{ substr(strtolower($product->description), 0,100) }}...</p>
                            <p>
                                <strong>Price: </strong> <span class='price'>{{ $product->price }}$ </span>
                            </p>
                            <p class="btn-holder">
                                <a href="{{ route('orderCart.store',$product->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a>
                            </p>
                            <p class="btn-holder">
                                <a href="{{  route('wishListCart.store',$product->id) }}" class="btn btn-dark btn-block text-center" role="button">Add to wishlist</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- End row -->

    </div>
@endsection
