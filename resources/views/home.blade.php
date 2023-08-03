@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                        @can('employee.view')
                            <h1>You can view Employee</h1>
                        @endcan
                        @can('employee.edit')
                            <h1>You can edit Employee</h1>
                        @endcan
                        @can('employee.delete')
                            <h1>You can delete Employee</h1>
                        @endcan
                        @can('candidate.view')
                            <h1>You can view Candidate</h1>
                        @endcan
                        @can('candidate.edit')
                            <h1>You can edit Candidate</h1>
                        @endcan
                        @can('candidate.delete')
                            <h1>You can delete Candidate</h1>
                        @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
