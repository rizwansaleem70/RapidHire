@extends('layouts.app')

@section('content')
@can('employee.view')
<h1><center>Total Users</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endcan
            </div>
        </div>
    </div>
@endsection


{{--    Just push my code sample trial--}}
