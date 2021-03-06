@extends('layouts.main')

@section('title', 'Admin')
@section('header', 'Update product')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        @csrf
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" value="{{ $product->name }}" required></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <select name="category_id" required>
                                    <option value="">Укажите категорию:</option>
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}"
                                                @if($product->category_id === $item->id) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="text" name="price" value="{{ $product->price }}" required></td>
                        </tr>
                        <tr>
                            <td>Photo</td>
                            <td><input type="file" name="productfile"></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><input type="text" name="description" value="{{ $product->description }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Update" class="btn btn-outline-primary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

@endsection
