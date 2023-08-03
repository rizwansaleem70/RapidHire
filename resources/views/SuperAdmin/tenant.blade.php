@extends('layouts.app')

@section('content')

    <h1>
        <center>All Tenants Page</center>
    </h1>

    <a href="{{route('tenant.create')}}">
        <button class="btn btn-primary">Create Tenant</button>
    </a>
    <br>
    <br>
    <br>
    <br>
    <ul>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tenant Name</th>
                <th>Domain Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    @foreach ($tenant as $item)
                    <td>{{ $item->name }}</td>
                    @endforeach
                    <td>{{ $row->domain }}</td>
                </tr>
        @endforeach
            </tbody>
        </table>

@endsection
