@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background: #f33b3b;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background: #c32f2f;
        }
        .table-container {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-white fw-bold mb-4">change.org</h4>
        <div class="text-center mb-4">
            <img src="https://via.placeholder.com/50" class="rounded-circle" alt="Admin">
            <p class="mt-2">admin</p>
        </div>
        <nav>
            <a href="{{ route('admin.home') }}" class="mb-2"><i class="bi bi-list-check"></i> Peticiones</a>
            <a href="{{route('admincategorias.index')}}" class="mb-2"><i class="bi bi-tags"></i> Categorías</a>
            <a href="{{ route('adminusers.index') }}"><i class="bi bi-people"></i> Usuarios</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <input type="text" class="form-control w-50" placeholder="Search Here">
                <div>
                    <i class="bi bi-bell me-3"></i>
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
        </nav>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Content Section -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
