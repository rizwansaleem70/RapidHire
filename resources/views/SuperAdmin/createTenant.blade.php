@extends('layouts.app')

@section('content')

    <div class="card-body">

        <form method="POST" action="{{route('tenant.store')}}">
            @csrf

            <div class="row mb-3">
                <label for="name"
                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-4">
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autocomplete="name"
                           autofocus placeholder="Enter Tenant Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="domain"
                       class="col-md-4 col-form-label text-md-end">{{ __('Domain') }}</label>
                <div class="col-md-4">
                    <input id="domain" type="text"
                           class="form-control @error('domain') is-invalid @enderror"
                           name="domain" value="{{ old('domain') }}" required autocomplete="domain"
                           autofocus placeholder="Enter Domain Name">
                    @error('domain')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">{{ __('Permissions of Employee') }}</label>
                <div class="col-md-4">
                    <label>View Employee</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="1">
                    <label>Edit Employee</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="2">
                    <label>Delete Employee</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="3">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">{{ __('Permissions of Candidate') }}</label>
                <div class="col-md-4">
                    <label>View Candidate</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="4">
                    <label>Edit Candidate</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="5">
                    <label>Delete Candidate</label>
                    <input id="assign_child" type="checkbox" name="assign_child[]" value="6">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>

        </form>

    </div>

@endsection
