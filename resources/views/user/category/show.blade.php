@extends('layouts.main')

@section('title', 'User')
@section('header', 'Category: ' . $category->name)

@section('content')

    <div class="content-main__container">
        <div class="products-category__list">
            @forelse($products as $product)
                <div class="products-category__list__item">
                    <div class="products-category__list__item__title-product">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                    </div>
                    <div class="products-category__list__item__thumbnail">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                           class="products-category__list__item__thumbnail__link">
                            <img src="{{ asset("storage/uploads/" . $product->photo) }}" alt="Preview-image">
                        </a>
                    </div>
                    <div class="products-category__list__item__description"><span class="products-price">{{ $product->price }} &#x20bd;</span>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        @else
                            <a href="#" class="btn btn-outline-primary">Buy</a>

                        @endguest
                    </div>
                </div>
            @empty
                <div class="alert alert-info">В категории <b>{{ $category->name }}</b> еще нет товара.</div>
            @endforelse
        </div>
    </div>

    {{$products->links() }}

@endsection
