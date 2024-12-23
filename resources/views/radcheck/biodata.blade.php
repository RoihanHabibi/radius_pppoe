<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card card-widget widget-user">
        <!-- Header -->
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $user->username }}</h3> <!-- Menampilkan username -->
            <h5 class="widget-user-desc">User</h5> <!-- Tampilkan deskripsi "User" -->
        </div>

        <!-- User Image -->
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ $user->avatar ?? asset('images/default-avatar.jpg') }}" alt="User Avatar">
        </div>

        <!-- Footer -->
        <div class="card-footer">
            <p><strong>User ID:</strong> {{ $user->id }}</p>
            <p><strong>Username:</strong> {{ $user->username }}</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
