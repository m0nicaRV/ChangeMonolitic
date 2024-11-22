@extends('layouts.public')
@section('content')

<form method="POST" action="{{route('peticiones.store')}}">
    <!--<input type="hidden" name="_token" value="...">
    <input type="hidden" name="_method" value="POST">-->
    @csrf
    <label for="titulo">Titulo: </label>
    <input type="text" name="titulo" id="titulo">

    <label for="descripcion">Descripcion: </label>
    <input type="text" name="descripcion" id="descripcion">

    <label for="destinatario">Destinatario: </label>
    <input type="text" name="destinatario" id="destinatario">

    <label for="estado">Estado: </label>
    <select name="estado" id="estado">
        <option value="aceptada">aceptada</option>
        <option value="pendiente">pendiente</option>
    </select>

    <label for="categoria">Categoria: </label>
    <select name="categoria" id="categoria">
        @foreach($categoria as $c)
            <option value="{{$c['id']}}">{{$c['nombre']}}</option>
        @endforeach
    </select>
    <input type="submit" value="enviar" >


    <ul>
        @foreach($validator as $v)
            <li></li>
        @endforeach
    </ul>




</form>
@endsection
