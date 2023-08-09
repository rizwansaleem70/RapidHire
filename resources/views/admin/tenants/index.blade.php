@extends('admin.layouts.main')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Yajra Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

            <h1>
                <center>All Tenants</center>
            </h1>
            <a href="{{route('tenant.create')}}">
                <button class="btn btn-primary">+ Tenant</button>
            </a>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="container">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Domain</th>
                                            <th>Database</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            </body>
                            <script type="text/javascript">
                              $(function () {
                                var table = $('.data-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('tenant.index') }}",
                                    columns: [
                                        {data: 'id', name: 'id'},
                                        {data: 'tenant_name', name: 'name'},
                                        {data: 'domain', name: 'domain'},
                                        {data: 'tenant_db',name: 'tenancy_db_name'},
                                        {data: 'action', name: 'action', orderable: false, searchable: false},
                                    ]
                                });
                              });
                            </script>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
