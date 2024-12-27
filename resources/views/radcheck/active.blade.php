@extends('layouts.app')

@section('title', 'Administrator Account')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Card for Active Administrators -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Administrators</h3>
                </div>

                <div class="card-body">
                    @if($active->isEmpty())
                        <p>No active administrators found.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($active as $admin)
                                    <tr>
                                        <td>{{ $admin->username }}</td>
                                        <td>
                                            @if($admin->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('radcheck.radcheck.editadmin', ['id' => $admin->id]) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-key"></i> Change Password
                                        </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
