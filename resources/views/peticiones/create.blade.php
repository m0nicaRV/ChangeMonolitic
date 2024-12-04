@extends('layouts.public')
@section('content')
    @if (!Auth::check())
        <script>
            window.location="{{route('login')}}";
        </script>
    @endif

    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>


    <form method="post" action="{{route('peticiones.store')}}" enctype="multipart/form-data" class="container mt-4 p-4 border rounded shadow my-3">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo')@enderror" placeholder="Escribe el título"  required>
            @error('titulo')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion:</label>
            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion')@enderror" rows="3" placeholder="Escribe una descripción" required></textarea>
            @error('descripcion')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="destinatario" class="form-label">Destinatario:</label>
            <input type="text" name="destinatario" id="destinatario" class="form-control @error('destinatario')@enderror" placeholder="Escribe el destinatario" required>
            @error('destinatario')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select">
                <option value="aceptada">Aceptada</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria:</label>
            <select name="categoria_id" id="categoria_id" class="form-select">
                @foreach($categoria as $c)
                    <option value="{{$c['id']}}">{{$c['nombre']}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen:</label>
            <input type="file" name="image" id="image" class="form-control @error('image')@enderror">
            @error('image')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Enviar</button>
        </div>
    </form>

@endsection
