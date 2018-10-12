@extends('layouts.layout')

@section('content')
    <div class="container bootstrap snipets">
        <h1 class="text-center text-muted">Products from category: {{ $name }}</h1>
        <div class="row flow-offset-1">

            @foreach($products as $product)
                <div class="col-xs-6 col-md-4">
                    <div class="product tumbnail thumbnail-3"><img src="{{ $product->image }}" alt="">
                        <div class="caption">
                            <h4><a href="#">{{ $product->title }}</a></h4>
                            <span class="price">{{ $product->price }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection