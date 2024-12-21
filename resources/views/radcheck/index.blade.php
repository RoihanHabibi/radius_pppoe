@extends('layouts.app')

@section('title', 'Daftar Pengguna PPPoE')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Pengguna PPPoE</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Tambah Pengguna Baru
    </button>

    <!-- Form Pencarian -->
    <div class="search-container mb-4">
        <form action="{{ route('radcheck.search') }}" method="GET">
            <div class="input-group">
                <input type="text" name="query" id="searchInput" placeholder="Cari username..." class="form-control" value="{{ old('query') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Main Content Area -->
    <div class="content-wrapper" style="margin-left: 260px; padding: 20px;">
            <!-- Menampilkan PPPoE Active dan inactive -->
            @if(request()->get('status') == 'enabled')
            <h3>PPPoE Active</h3>
            @elseif(request()->get('status') == 'disabled')
            <h3>PPPoE Inactive</h3>
            @else
            <h3>Daftar Semua Pengguna PPPoE</h3>
            @endif
                <table class="table table-bordered mb-5">
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
                                           {{ $user['status'] == 'enabled' ? 'checked' : '' }}>
                                    <label class="form-check-label"></label>
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

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('radcheck.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambahkan Pengguna</h5>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
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
            const status = $(this).is(':checked') ? 'enabled' : 'disabled';

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

        // Hapus pengguna
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

@endsection
