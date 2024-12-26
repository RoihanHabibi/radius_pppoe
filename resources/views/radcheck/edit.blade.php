@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card for editing user -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $radcheck->status == 1 ? 'PPPoE Active' : 'PPPoE Inactive' }}
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Form for editing user -->
                    <form action="{{ route('radcheck.update', $radcheck->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $radcheck->username }}" readonly>
                        </div>
                        <div class="mb-3">
                            <!-- Button to open modal for changing password -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                Change Password
                            </button>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input status-btn" type="checkbox" data-id="{{ $radcheck->id }}" name="enabled" value="1" {{ $radcheck->status == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="enabled">Status</label>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('radcheck.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Changing Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('radcheck.change_password', $radcheck->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="fas fa-eye" id="passwordIcon"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="generatePassword">Generate</button>
                        </div>
                        <small class="form-text text-muted">Click "Generate" to create a random password or toggle to view it.</small>
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

@section('scripts')
<script>
    // Generate random password (max 8 characters)
    document.getElementById('generatePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('new_password');
        const randomPassword = Array(8).fill(null).map(() =>
            String.fromCharCode(Math.floor(Math.random() * (126 - 33 + 1)) + 33)
        ).join('');
        passwordField.value = randomPassword;
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('new_password');
        const passwordIcon = document.getElementById('passwordIcon');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = "password";
            passwordIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Update Status PPPoE
    $('.status-btn').on('click', function () {
        const id = $(this).data('id');
        const newStatus = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: `/radcheck/${id}/update_status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function (response) {
                Swal.fire('Success', 'Status updated successfully', 'success');
            },
            error: function (xhr) {
                Swal.fire('Error', 'Failed to update status', 'error');
            }
        });
    });
</script>
@endsection
