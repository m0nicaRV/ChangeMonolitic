<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peticione;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class PeticioneController extends Controller
{
    //
    public function index(){
        $peticiones=Peticione::all();
        $users=User::all();
        return view('peticiones.index',compact('peticiones','users'));

    }

    public function store(request $request){

            $validator =Validator::make($request->all(),[
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'destinatario' => 'required|string|max:255',
                'categoria' => 'required|exists:categorias,id',
                'estado'=> 'required'
            ]);
            $categoria=Categoria::all();
            if($validator->fails()){
                return view('peticiones.create',compact('validator','categoria'));
            }


            $peticion= new Peticione;
            $peticion['titulo']=$request->input('titulo');
            $peticion['descripcion']=$request->input('descripcion');
            $peticion['destinatario']=$request->input('destinatario');
            $peticion['categoria_id']=$request->input('categoria');
            $peticion['estado']=$request->input('estado');
            $peticion['user_id']=1;
            $peticion['firmantes']=0;
            $peticion->save();

            return view('peticiones.show',compact('peticion'));

    }
    public function create(){
        $categoria=Categoria::all();
        return view('peticiones.create',compact('categoria'));


    }




}
