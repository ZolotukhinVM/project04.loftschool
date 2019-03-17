@extends('layouts.main')

@section('title', 'User')
@section('header', $product->name)

@section('content')
    <div class="alert alert-info">
        <b>Количество просмотров: {{ $product->view }}</b>
    </div>
    <p>{{ $product->description }}</p>
    <h1>{{ $product->price }} &#x20bd;</h1>
    @guest
        <div class="alert alert-warning" role="alert">Please sign in to buy this product!</div>
    @else
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('order.store') }}" method="post">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value="{{ Auth::user()->name }}" required></td>
                </tr>
                <tr>
                    <td>Mail</td>
                    <td><input type="text" name="email" value="{{ Auth::user()->email }}" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Create order" class="btn btn-outline-primary">
                    </td>
                </tr>
            </table>
        </form>
    @endguest

@endsection
