@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           placeholder="Enter Name" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           placeholder="Enter Email" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           placeholder="Enter Password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm your Password" required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Permissions Name</label>

                                <div class="col-md-6">
                                    <label class="form-check-label" for="flexCheckDefault">View Employee</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="1">

                                    <label class="form-check-label" for="flexCheckDefault">Edit Employee</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="2">

                                    <label class="form-check-label" for="flexCheckDefault">Delete Employee</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="3">

                                    <label class="form-check-label" for="flexCheckDefault">View Candidate</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="4">

                                    <label class="form-check-label" for="flexCheckDefault">Edit Candidate</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="5">

                                    <label class="form-check-label" for="flexCheckDefault">Delete Candidate</label>
                                    <input id="assign_child" type="checkbox" name="assign_child[]" value="6">
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{route('user.create')}}">
                                        <button type="submit" class="btn btn-primary">
                                            Create
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
