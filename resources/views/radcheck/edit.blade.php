@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card for editing user -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $radcheck->status == 1 ? 'PPPoE Active' : 'PPPoE Inactive' }}
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Form for editing user -->
                    <form action="{{ route('radcheck.update', $radcheck->id) }}" method="POST" id="editUserForm">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $radcheck->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <!-- Button to open modal for changing password -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal">
                                Change Password
                            </button>
                        </div>
                        <div class="form-group form-check">
                            <input 
                                class="form-check-input status-btn" 
                                type="checkbox" 
                                id="enabled" 
                                name="enabled" 
                                value="1" 
                                {{ $radcheck->status == 1 ? 'checked' : '' }} 
                                {{ session('password_changed') ? '' : 'disabled' }} 
                            >
                            <label class="form-check-label" for="enabled">Status</label>
                            <small class="form-text text-muted">
                                {{ session('password_changed') == 1 ? 'You can now enable the status.' : 'Please change the password first.' }}
                            </small>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ isset($radcheck) ? route('radcheck.change_password', $radcheck->id) : '#' }}" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye" id="passwordIcon"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="generatePassword">Generate</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Click "Generate" to create a random password or toggle to view it.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusCheckbox = document.querySelector('.status-btn');
    const passwordField = document.getElementById('new_password');
    const saveButton = document.querySelector('button[type="submit"]');
    const generatePasswordButton = document.getElementById('generatePassword');
    const editUserForm = document.getElementById('editUserForm');
    let isPasswordChanged = {{ session('password_changed') ? 'true' : 'false' }}; // Cek status password diubah atau tidak

    // Event listener untuk tombol Generate Password
    if (generatePasswordButton) {
        generatePasswordButton.addEventListener('click', function () {
            const length = 6; // Panjang password
            let password = "";
            for (let i = 0; i < length; i++) {
                const randomDigit = Math.floor(Math.random() * 10); // Angka acak 0-9
                password += randomDigit;
            }
            passwordField.value = password; // Isi field password
            isPasswordChanged = true; // Tandai bahwa password telah diubah
        });
    }

    // Event listener untuk input manual pada field password
    passwordField.addEventListener('input', function () {
        isPasswordChanged = passwordField.value.trim() !== ""; // Tandai jika ada input manual
    });

    // Toggle password visibility
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordIcon = document.getElementById('passwordIcon');
    if (togglePasswordButton) {
        togglePasswordButton.addEventListener('click', function () {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = "password";
                passwordIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    }

    // Pastikan status disimpan hanya setelah form disubmit
    if (saveButton && editUserForm) {
        saveButton.addEventListener('click', function (event) {
            // Hapus input hidden yang lama jika ada
            const existingHiddenInput = document.querySelector('input[name="enabled"]');
            if (existingHiddenInput) {
                existingHiddenInput.remove();
            }

            // Tambahkan input hidden untuk status
            const statusHiddenField = document.createElement('input');
            statusHiddenField.type = 'hidden';
            statusHiddenField.name = 'enabled'; // Menyimpan status ke field "enabled"
            statusHiddenField.value = statusCheckbox.checked ? 1 : 0; // Simpan status checkbox (1 atau 0)

            // Menambahkan input hidden ke dalam form
            editUserForm.appendChild(statusHiddenField);

            // Setelah menambahkan input hidden, submit form
            editUserForm.submit();
        });
    } else {
        console.error('Tombol Save atau form tidak ditemukan');
    }
});

</script>

@endsection

<!-- Bootstrap 4 CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- AdminLTE CSS -->
<link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css" rel="stylesheet">
