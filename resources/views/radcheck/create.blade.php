@extends('layouts.app')

@section('title', 'Tambah User Radcheck')

@section('content')
    <div class="container-fluid">
        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card for the form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah User Radcheck</h3>
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
                                    <input type="password" name="password" id="password" class="form-control" required>
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
