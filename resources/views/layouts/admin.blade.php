@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE htmt>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilo de la sidebar */
        .sidebar {
            background-color: #ff4d4d; /* Rojo */
            color: white;
            min-height: 100vh;
            width: 250px;
        }
        /* Estilo del menú desplegable */
        .dropdown-menu {
            background-color: #ff4d4d; /* Rojo */
            border: none;
        }
        .dropdown-menu a {
            color: white; /* Texto blanco para los enlaces */
        }
        .dropdown-menu a:hover {
            background-color: #ff6666; /* Rojo más claro al pasar el cursor */
        }
    </style>
</head>
<body class="bg-light">
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="fw-bold mb-4">change.org</h4>

        <!-- Menú del Usuario -->
        <div>
            <div class="dropdown">
                <!-- Botón del Menú Desplegable -->
                <a class="nav-link dropdown-toggle fs-4 text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <!-- Opciones del Menú Desplegable -->
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item fs-5 text-white bg-danger border-0">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Navegación del Sidebar -->
        <nav class="mt-4">
            <a href="{{ route('admin.home') }}" class="text-white d-block mb-3"><i class="bi bi-list-check me-2"></i> Peticiones</a>
            <a href="{{ route('admincategorias.index') }}" class="text-white d-block mb-3"><i class="bi bi-tags me-2"></i> Categorías</a>
            <a href="{{ route('adminusers.index') }}" class="text-white d-block"><i class="bi bi-people me-2"></i> Usuarios</a>
        </nav>
    </div>



=======
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

>>>>>>> 0f06df6092cc400c5d2802eef646eb992ac1a523
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
