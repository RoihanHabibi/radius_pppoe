@extends('layouts.app')
@section('title', 'edit user')
@section('content')

    <div class="mb-4">
    <div class="container mt-5">
        <h1 class="mb-4">Edit Pengguna</h1>

        <form action="{{ route('radcheck.update', $radcheck->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $radcheck->username }}" required>
            </div>
            <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Change Password
              </button>
            </div>
            <div class="mb-3">
              <a href="/radcheck" class="btn btn-secondary">back</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('radcheck.change_password', $radcheck->id) }}" method="post">
      <div class="modal-body">
      <div class="mb-3">
      @csrf
                <label for="password" class="form-label">Old Password</label>
                <input type="password" class="form-control" id="password" name="old_password" required>
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="new_password" required>
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

