@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cambio - Bootstrap 5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <div class="container">
        <a class="navbar-brand text-danger fs-2" href="{{route('home')}}">Change.org</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fs-4 m-2" href="{{ route('peticiones.index') }}">Peticiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-4 m-2" href="{{ route('peticiones.create') }}">Inicia una petición</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4 m-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::getUser()->name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li> <a class="nav-link fs-4 m-2" href="{{ route('peticiones.mine') }}">Mis peticiones</a></li>
                            <li> <a class="nav-link fs-4 m-2" href="{{ route('peticiones.peticionesfirmadas') }}">Mis firmas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="nav-link fs-4 link-danger border-0 bg-transparent">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link fs-4 m-2 link-danger" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4 m-2 link-danger" href="{{route('register')}}">Register</a>
                        </li>
                    </ul>
                @endif
            </ul>
        </div>
    </div>
</nav>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



    @yield('content')




<footer class="bg-light text-dark pt-4">
    <div class="container">
        <div class="row">
            <!-- Acerca de -->
            <div class="col-md-3 mb-3">
                <h6 class="text-uppercase fw-bold">Acerca de</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-danger">Sobre Change.org</a></li>
                    <li><a href="#" class="text-danger">Impacto</a></li>
                    <li><a href="#" class="text-danger">Empleo</a></li>
                    <li><a href="#" class="text-danger">Equipo</a></li>
                </ul>
            </div>
            <!-- Comunidad -->
            <div class="col-md-3 mb-3">
                <h6 class="text-uppercase fw-bold">Comunidad</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-danger">Blog</a></li>
                    <li><a href="#" class="text-danger">Prensa</a></li>
                    <li><a href="#" class="text-danger">Normas de la Comunidad</a></li>
                </ul>
            </div>
            <!-- Ayuda -->
            <div class="col-md-3 mb-3">
                <h6 class="text-uppercase fw-bold">Ayuda</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-danger">Ayuda</a></li>
                    <li><a href="#" class="text-danger">Privacidad</a></li>
                    <li><a href="#"  class="text-danger">Términos</a></li>
                    <li><a href="#" class="text-danger">Política de  cookies</a></li>
                    <li><a href="#" class="text-danger">Gestionar  cookies</a></li>
                    <li><a href="#" class="text-danger">Términos</a></li>
                    <li> <a href="#"  class="text-danger">Cookies</a></li>
                </ul>
            </div>
            <!-- Redes sociales -->
            <div class="col-md-3 mb-3">
                <h6 class="text-uppercase fw-bold">Redes sociales</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-danger">Twitter</a></li>
                    <li><a href="#" class="text-danger">Facebook</a></li>
                    <li><a href="#" class="text-danger">Instagram</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright and Language Selector -->
        <div
            class="d-flex justify-content-between align-items-center border-top pt-3">
            <p class="mb-0">© 2024, Change.org, PBC</p>
            <p class="mb-0 small">Esta web está protegida por reCAPTCHA  y por Google <a href="#" class="text-dark">Política de privacidad</a> y <a href="#" class="text-dark">Normas de uso</a>.</p>
            <select class="form-select form-select-sm"  style="width: 150px;">
                <option selected>Español (España)</option>
                <option>Inglés (Estados Unidos)</option>
                <option>Francés (Francia)</option>
                <!-- Agrega más idiomas según sea necesario -->
            </select>
        </div>
    </div>
</footer>
</body>
</html>


