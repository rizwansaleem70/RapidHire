@extends('admin.layouts.main')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Tenant</h4>
                            </div>
                            <form method="POST" action="{{route('tenant.store')}}">
                                @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">Tenant Name</label>
                                            <input type="text" class="form-control" id="basicInput" name="name" placeholder="Enter Tenant Name" />
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">Domain Name</label>
                                            <input type="text" class="form-control" id="basicInput" name="domain" placeholder="Enter Domain Name" />
                                        </div>
                                        @error('domain')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">

                                            <button type="submit" class="form-control btn btn-primary" id="basicInput">{{ __('Create') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>
</div>
@endsection
