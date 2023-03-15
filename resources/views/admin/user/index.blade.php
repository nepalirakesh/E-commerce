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
                        <h4 class="text-center">View Users
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        @if (count($users) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $users->firstItem() + $loop->index }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="container text-center">
                                        <p>Currently there are no users.</p>
                                    </div>
                        @endif
                        </tbody>
                        </table>
                    </div>
                    <ul class="pagination justify-content-center">
                        {!! $users->links('pagination::bootstrap-4') !!}
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->
@endsection
