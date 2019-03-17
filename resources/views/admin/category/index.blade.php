@extends('layouts.main')

@section('title', 'Admin')
@section('header', 'Categories')

@section('content')

    <div class="container">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Create new category</a><br><br>
        <div class="row justify-content-center">
            @if (count($category) != 0)
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date created</th>
                        <th>Count products</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($category as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ count($item->products) }}</td>
                            <td><a href="{{ route('category.edit', ['id' => $item->id]) }}"
                                   class="btn btn-outline-secondary">Update</a></td>
                            <td>
                                @if(count($item->products) > 0)
                                    <a data-toggle="modal" data-target="#exampleModal" href="#"
                                       class="btn btn-outline-danger">
                                        Delete
                                    </a>
                                @else
                                    <a href="{{ route('category.destroy', ['id' => $item->id]) }}"
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
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Удаление невозможно! Категория содержит товары.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{ $category->links() }}

@endsection
