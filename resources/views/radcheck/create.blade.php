@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid">
        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card for the form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah User FreeRADIUS</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form for adding a user -->
                        <form action="{{ route('radcheck.store') }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="text" name="password" id="password" class="form-control" readonly>
                                        <button type="button" class="btn btn-secondary" id="generatePassword">Generate Password</button>
                                    </div>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" id="enabled" name="enabled" value="1">
                                    <label class="form-check-label" for="enabled">Aktifkan Pengguna</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('generatePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const randomPassword = Array(12).fill(null).map(() =>
                String.fromCharCode(Math.floor(Math.random() * (126 - 33 + 1)) + 33)
            ).join('');
            passwordField.value = randomPassword;
        });
    </script>
@endsection
