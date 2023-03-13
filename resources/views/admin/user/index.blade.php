@extends('layouts.dashboard.master')
@section('title', 'View Users')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="card">
                    <div class="card-header">
                        <h4>View Users
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th data-sortable="true">Name</th>
                                    <th data-sortable="true">Email</th>
                                    <th data-sortable="true">Created At</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                        {{ $users->links() }}

                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->
@endsection
