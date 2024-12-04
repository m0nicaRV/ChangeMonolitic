
@extends('layouts.public')
@section('content')

    <div class="container mt-4 my-5">
        <div class="card shadow border-0">
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
                    <strong>Usuario ID:</strong> {{$peticion['user_id']}}
                </p>
                <p class="card-text">
                    <strong>Categoría:</strong> {{$categoria['nombre']}}
                </p>
            </div>
        </div>
    </div>






@endsection


