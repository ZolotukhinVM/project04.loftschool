@extends('layouts.main')

@section('title', 'Hello')
@section('header', 'Products')

@section('content')

    <div class="container">
        <a href="{{ route('product.create') }}" class="btn btn-primary">
            Create new product
        </a>
        <br><br>
        @if (count($products)!=0)
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Photo</th>
                    <th>Date created</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td><a href="../../upload/products/{{ $product->photo }}" target="_blank">Photo</a></td>
                        <td>
                            <a href="{{ route('product.edit', ['id'=>$product->id]) }}"
                               class="btn btn-outline-secondary">
                                Update
                            </a>
                        </td>
                        <td>
                            @if(isset($product->order))
                                <a data-toggle="modal" data-target="#exampleModal" href="#"
                                   class="btn btn-outline-danger">
                                    Delete
                                </a>
                            @else
                                <a href="{{ route('product.destroy', ['id'=>$product->id]) }}"
                                   class="btn btn-outline-danger">
                                    Delete
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Удаление невозможно! Товар находится в таблице заказов.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{ $products->links() }}

@endsection
