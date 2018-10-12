@extends('layouts.layout')

@section('content')
    <div class="container bootstrap snipets">
        <h1 class="text-center text-muted">Product catalog of 20 most popular products</h1>
        <div class="row flow-offset-1">

            @foreach($products as $product)
                <div class="col-xs-6 col-md-4">
                    <div class="product tumbnail thumbnail-3"><img src="{{ $product->image }}" alt="">
                        <div class="caption">
                            <h4><a href="#">{{ $product->title }}</a></h4>
                            <span class="price">{{ $product->price }}</span>
                            <h5>Categories</h5>
                            @foreach($product->categories as $category)
                                <h6><a href="{{ url('/catalog/category/'.$category->alias) }}">{{ url('/catalog/category/'.$category->alias) }}</a></h6>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection