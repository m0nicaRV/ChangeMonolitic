<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peticione;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Validator;

class PeticioneController extends Controller
{
    //
    public function index(){
        $peticiones=Peticione::all();
        $users=User::all();
        return view('peticiones.index',compact('peticiones','users'));

    }

    public function create(request $request){
        if($request = null){
            return view('peticiones.create');

        }else{
            $validator =Validator::make($request->all(),[
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'destinatario' => 'required|string|max:255',
                'categoria' => 'required|exists:categorias,nombre',
                'estado'=> 'required'
            ]);
            if($validator->fails()){
                return view('peticiones.create',compact('validator'));
            }
            $categoria=Categoria::where('id',$request->get('categoria'))->firstOrFail();


        }



    }
}
