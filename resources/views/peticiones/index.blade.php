@extends('layouts.public')
@section('content')

    <div class="container mt-4">
        @foreach($peticiones as $peticion)
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Imagen a la izquierda -->
                    <div class="col-md-4">
                        <img src="/peticiones/{{ $peticion->file->file_path }}" class="img-fluid rounded-start" alt="Imagen de la petición">
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $peticion['titulo'] }}</h5>
                            <p class="card-text">{{ $peticion['descripcion'] }}</p>
                            <p class="card-text"><small class="text-muted">Firmas: {{ $peticion['firmantes'] }}</small></p>
                            <p class="card-text"><small class="text-muted">Usuario: {{ $peticion->user->name }}</small></p>
                            <a href="{{ route('peticiones.show', $peticion->id) }}" class="btn btn-danger">+Info</a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
