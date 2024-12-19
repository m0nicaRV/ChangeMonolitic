@extends('layouts.admin')



@section('content')
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Usuario</h4>
        </div>
        <table class="table table-bordered table-striped align-middle text-center">
            <thead>
            <tr>

                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>

                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                @if ($user->role_id==1)
                    <td>Admin</td>
                @else
                    <td>User</td>
                @endif
                <td>
                    <form action="{{route('adminusers.rol', $user->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-shift-fill"></i></button>
                    </form>
                    <a class="btn btn-primary btn-sm" href="{{route ('adminusers.show', $user->id)}}"><i class="bi bi-eye"></i></a>
                    <form action="{{route('adminusers.delete', $user->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i></button>
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

