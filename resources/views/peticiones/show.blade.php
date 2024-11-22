@extends('layouts.public')
@section('content')

        <div>
            <h1>{{$peticion['titulo']}}</h1>
            <p>{{$peticion ['descripcion']}}</p>
            <p>{{$peticion ['destinatario']}}</p>
            <p>{{$peticion ['estado']}}</p>
            <p>{{$peticion ['user_id']}}</p>
            <p>{{$peticion ['categoria_id']}}</p>
        </div>





@endsection


