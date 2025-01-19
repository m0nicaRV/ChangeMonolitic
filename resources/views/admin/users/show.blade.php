
@extends('layouts.admin')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger p-3 m-2 rounded-2 d-flex justify-content-center">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="container mt-4 my-5">
        <div class="card shadow border-0">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title text-primary mb-4">{{$user->is}}</h1>
                        <p class="card-text">
                            <strong>Nombre: </strong> {{$user->name}}
                        </p>
                        <p class="card-text">
                            <strong>Email</strong> {{$user->email}}
                        </p>
                        <p class="card-text">
                            <strong>Rol:</strong>
                            @if ($user->role_id == 1)
                                <span>Admin</span>
                            @else
                                <span>User</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection


