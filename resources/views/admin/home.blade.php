@extends('layouts.admin')



@section('content')
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Peticiones</h4>
            <a href="{{ route('adminpeticiones.create') }}" class="btn btn-primary">New</a>
        </div>
        <table class="table table-bordered table-striped align-middle text-center">
            <thead>
            <tr>

                <th>Id</th>
                <th>Autor</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Firmantes</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($peticiones as $peticion)
            <tr>

                <td>{{$peticion->id}}</td>
                <td>{{$peticion->user->name}}</td>
                <td>{{$peticion->titulo}}</td>
                <td>{{$peticion->descripcion}}</td>
                <td>{{$peticion->firmantes}}</td>
                <td>{{$peticion->estado}}</td>
                <td>
                    <a class="btn btn-success btn-sm" href="{{route('adminpeticiones.edit', $peticion->id)}}"><i class="bi bi-pencil"></i></a>
                    <a class="btn btn-success btn-sm" href="{{route('adminpeticiones.estado', $peticion->id)}}" onclick="event.preventDefault();document.getElementById('cambiarestado').submit();"><i class="bi bi-shift-fill"></i></a>
                    <a class="btn btn-primary btn-sm" href="{{route ('adminpeticiones.show', $peticion->id)}}"><i class="bi bi-eye"></i></a>
                    <a class="btn btn-danger btn-sm" href="{{route('adminpeticiones.delete', $peticion->id)}}"
                       onclick="event.preventDefault();document.getElementById('delete').submit();">
                        <i class="bi bi-trash"></i>
                    </a>
                    <form  id="delete" action="{{route('adminpeticiones.delete', $peticion->id)}}" style="display: none;" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <form  id="cambiarestado" action="{{route('adminpeticiones.estado', $peticion->id)}}" style="display: none;" method="POST">
                        @csrf
                        @method('PUT')
                    </form>
                </td>
            </tr>
            @endforeach
            <!-- Más filas aquí -->
            </tbody>
        </table>
        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
            </ul>
        </nav>
    </div>
@endsection

