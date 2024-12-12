
@extends('layouts.public')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger p-3 m-2 rounded-2 d-flex justify-content-center">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="container mt-4 my-5">
        <div class="card shadow border-0">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/peticiones/{{ $peticion->file->file_path }}" class="img-fluid rounded-start" alt="Imagen de la petición">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title text-primary mb-4">{{$peticion['titulo']}}</h1>
                        <p class="card-text">
                            <strong>Descripción:</strong> {{$peticion['descripcion']}}
                        </p>
                        <p class="card-text">
                            <strong>Destinatario:</strong> {{$peticion['destinatario']}}
                        </p>
                        <p class="card-text">
                            <strong>Estado:</strong>
                            <span class="badge {{$peticion['estado'] == 'aceptada' ? 'bg-success' : 'bg-warning'}}">
                        {{ucfirst($peticion['estado'])}}
                        </span>
                        </p>
                        <p class="card-text">
                            <strong>Usuario ID:</strong> {{$peticion->user->name}}
                        </p>
                        <p class="card-text">
                            <strong>Firmas:</strong> {{$peticion->firmantes}}
                        </p>
                        <p class="card-text">
                            <strong>Categoría:</strong> {{$categoria['nombre']}}
                        </p>
                        @if(Auth::check())
                        <a class="btn btn-success" href="{{route('peticiones.firmar', $peticion->id)}}"
                           onclick="event.preventDefault();document.getElementById('firmar').submit();">
                            Firmar
                        </a>
                        <form method="POST" id="firmar" action="{{route('peticiones.firmar', $peticion->id)}}" style="display: none;">
                            @csrf
                        </form>
                        @if(Auth::id() == $peticion->user->id)
                            <a class="btn btn-danger" href="{{route('peticiones.delete', $peticion->id)}}"
                               onclick="event.preventDefault();document.getElementById('delete').submit();">
                               Delete
                            </a>
                            <form  id="delete" action="{{route('peticiones.delete', $peticion->id)}}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                                <a class="btn btn-success fs-4 m-2 " href="{{route('peticiones.edit', $peticion->id) }}">actualizar</a>
                            @endif



                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection


