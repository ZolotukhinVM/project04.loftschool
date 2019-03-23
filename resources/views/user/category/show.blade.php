@extends('layouts.main')

@section('title', 'User')
@section('header', 'Category: ' . $category->name)

@section('content')
    <div class="content-main__container">
        <div class="products-category__list">
            @isset(Auth::user()->id)
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            @endisset
            @forelse($products as $product)
                <div class="products-category__list__item">
                    <div class="products-category__list__item__title-product">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                    </div>
                    <div class="products-category__list__item__thumbnail">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                           class="products-category__list__item__thumbnail__link">
                            <img src="{{ asset("storage/uploads/" . $product->getPhoto()) }}" alt="Preview-image">
                        </a>
                    </div>
                    <div class="products-category__list__item__description"><span class="products-price">{{ $product->price }} &#x20bd;</span>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        @else
                            <div id="res_{{ $product->id }}"></div>
                            <button data-product="{{ $product->id }}" class="btn btn-outline-primary">Buy
                            </button>
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

@section('js')
    <script>
        $(".btn").click(function () {
            product_id = $(this).data('product');
            $(this).prop('disabled', true);
            $.get('/ajax/order', {id: product_id, ajax: 1}, function () {
                // data = JSON.parse(resp);
                $('#res_' + product_id).html("Order is added")
                    .fadeIn(300)
                    .delay(3200)
                    .fadeOut(300);
            });
            $order_count = $('#order-count').text();
            $order_count = $('#order-count').text(Number($order_count) + 1);
        });
    </script>
@endsection
