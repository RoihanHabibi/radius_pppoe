@extends('layouts.app')
@section('title', 'tambah user')
<body>
    <h1>Tambah User Radcheck</h1>
    
    <form method="POST" action="{{ route('radcheck.store') }}">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    
    <br>
    <a href="{{ route('radcheck.index') }}">Kembali ke Daftar User</a>
</body>

