@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalActive }}</h3>

                        <p>Total Users Active</p>
                    
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <a href="{{ url('radcheck?status=enabled') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalInactive }}</h3>

                        <p>Total Users Inactive</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-times"></i>
                    </div>

                    <a href="{{ url('radcheck?status=disabled') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        
        <!-- Tabel untuk menampilkan nomor, SID, dan tanggal penggunaan -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengguna Terbaru</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SID</th>
                            <th>Username</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentUsers as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['username'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->tanggal_penggunaan)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
