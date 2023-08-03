@extends('layouts.app')

@section('content')

    <h1>
        <center>All Users Page</center>
    </h1>

    <a href="{{route('user.create')}}">
        <button class="btn btn-primary">Create User</button>
    </a>
    <br>
    <br>
    <br>
    <br>
    <ul>
        <table class="table table-striped col-8 align-items-center table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endsection
