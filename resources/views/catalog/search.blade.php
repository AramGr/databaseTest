@extends('layouts.layout')

@section('content')
    <div class="container bootstrap snipets">
        <h3 class="text-center text-muted">Result from the search: {{ $title }}</h3>
        <div class="row flow-offset-1">

            @foreach($products as $product)
                <div class="col-xs-6 col-md-4">
                    <div class="product tumbnail thumbnail-3"><img src="{{ $product->image }}" alt="">
                        <div class="caption">
                            <h4><a href="#">{{ $product->title }}</a></h4>
                            <span class="price">{{ $product->price }}</span>
                            <h5>Categories</h5>
                            @foreach($product->categories as $category)
                                <h6><a href="{{ url('/catalog/category/'.$category->alias) }}">{{$category->title }}</a></h6>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection