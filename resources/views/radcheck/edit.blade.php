@extends('layouts.app')

@section('title')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card for editing user -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pengguna</h3>
                </div>
                <div class="card-body">
                    <!-- Form for editing user -->
                    <form action="{{ route('radcheck.update', $radcheck->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $radcheck->username }}" required>
                        </div>
                        <div class="mb-3">
                            <!-- Button to open modal for changing password -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Change Password
                            </button>
                        </div>
                        <div class="form-group">
                            <a href="/radcheck" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for changing password -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('radcheck.change_password', $radcheck->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<!-- Include Bootstrap JS if not already included -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
