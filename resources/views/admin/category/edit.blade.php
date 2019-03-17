@extends('layouts.main')

@section('title', 'Admin')
@section('header', 'Edit category')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{route('category.update', ['id' => $category->id])}}" method="post">
                    <table class="table table-bordered">
                        @csrf
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" value="{{ old('name') ?? $category->name }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><input type="text" name="description"
                                       value="{{ old('description') ?? $category->description }}" required></td>
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
