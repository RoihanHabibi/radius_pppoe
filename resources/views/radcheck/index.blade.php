@extends('layouts.app')

@section('title', 'Daftar Pengguna PPPoE')

@section('content_header')
    <h1>Daftar Pengguna PPPoE</h1>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Tombol untuk membuka modal Tambah Pengguna
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Tambah Pengguna Baru
    </button> -->
    
    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('radcheck.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambahkan Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="enabled" name="enabled" value="1">
                        <label class="form-check-label" for="enabled">Aktifkan Pengguna</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="mb-4">
        <form action="{{ route('radcheck.search') }}" method="GET">
            <div class="input-group">
                <input type="text" name="query" id="searchInput" placeholder="Cari username..." class="form-control" value="{{ old('query') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Judul Berdasarkan Status -->
    <h3>
        @if(request()->get('status') == 'enabled')
            PPPoE Active
        @elseif(request()->get('status') == 'disabled')
            PPPoE Inactive
        @else
            Daftar Semua Pengguna PPPoE
        @endif
    </h3>

    <!-- Tabel Daftar Pengguna -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SID</th>
                        <th>Username</th>
                        <th>Time Date</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($radcheck as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['tanggal_penggunaan'] }}</td>
                        <td>{{ $user['unit'] ?? 'Tidak ada' }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-btn" type="checkbox" 
                                       name="status_switch" 
                                       data-id="{{ $user['id'] }}" 
                                       {{ $user['status'] == 1 ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('radcheck.edit', $user['id']) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm delete-button" data-id="{{ $user['id'] }}">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        const csrfToken = '{{ csrf_token() }}';

        // Update Status PPPoE
        $('.status-btn').on('change', function () {
            const id = $(this).data('id');
            const status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `/radcheck/${id}/update_status`,
                type: 'POST',
                data: {
                    _token: csrfToken,
                    status: status
                },
                success: function (response) {
                    Swal.fire('Success', 'Status updated successfully', 'success');
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Failed to update status', 'error');
                }
            });
        });

        // Hapus Pengguna
        $(document).on('click', '.delete-button', function () {
            if (!confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) return;

            const id = $(this).data('id');

            $.ajax({
                url: `/radcheck/${id}`,
                type: 'DELETE',
                data: {
                    _token: csrfToken,
                },
                success: function (response) {
                    Swal.fire('Success', 'Pengguna berhasil dihapus', 'success');
                    location.reload();
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Terjadi kesalahan', 'error');
                }
            });
        });
    });
</script>

<script>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</script>
@endsection
