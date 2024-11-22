@extends('layouts.public')
@section('content')

<form method="GET" action="/peticion/add">
    <!--<input type="hidden" name="_token" value="...">
    <input type="hidden" name="_method" value="POST">-->
    <label for="titulo">Titulo: </label>
    <input type="text" name="titulo" id="titulo">

    <label for="descripcion">Descripcion: </label>
    <input type="text" name="descripcion" id="descripcion">

    <label for="destinatario">Destinatario: </label>
    <input type="text" name="dsetinatario" id="destinatario">

    <label for="Estado">Estado: </label>
    <select name="estado" id="estado">
        <option value="aceptada">aceptada</option>
        <option value="pendiente">pendiente</option>
    </select>

    <label for="Categoria">Categoria: </label>
    <select name="categoria" id="categoria">
        @foreach($categorias as $categoria)
            <option value="{{}}">{{}}</option>
        @endforeach
    </select>




</form>
@endsection
