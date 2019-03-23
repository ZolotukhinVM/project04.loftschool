@extends('layouts.main')

@section('title', 'User')
@section('header', "Orders / " . $orders->total())

@section('content')

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Product</th>
            <th>Created</th>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->email}}</td>
                <td>
                    <a href="{{ route('product.detail', ['id'=>$order->product->id]) }}">
                        {{$order->product->name}}
                    </a>
                </td>
                <td>{{$order->created_at}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Заказов еще не добавлялось!
                </td>
            </tr>
        @endforelse
    </table>

    {{$orders->links() }}

@endsection
