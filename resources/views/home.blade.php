@extends('layouts.main')

@section('title', 'Hello')
@section('header', 'Profile')
@section('content')

    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>{{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></td>
        </tr>
        <tr>
            <td>Created</td>
            <td>{{ Auth::user()->created_at }}</td>
        <tr>
            <td>Updated</td>
            <td>{{ Auth::user()->updated_at }}</td>
        </tr>
    </table>

@endsection
