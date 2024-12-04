<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peticione;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Tests\Validation\ValidatorAfterRuleTest;
use PharIo\Version\Exception;

class PeticioneController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('index','show');
    }
    public function index(){
        $peticiones=Peticione::where('estado', 'aceptada')->orderBy('created_at', 'desc')->get();
        return view('peticiones.index',compact('peticiones',));

    }

    public function listMine(){
            $peticiones=Peticione::where('user_id',Auth::user()->getAuthIdentifier())->get();
            return view('peticiones.index',compact('peticiones'));
    }



    public function store(request $request){
            $validator =Validator::make($request->all(),[
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'destinatario' => 'required|string|max:255',
                'categoria' => 'required|exists:categorias,id',
                'estado'=> 'required',
                'file'=>'required'
            ]);
            $input=$request->all();
            try{

                $user=Auth::user();
                $peticion =new Peticione($input);
                $peticion->categoria()->associate($input['categoria_id']);
                $peticion->user()->associate($user);
                $peticion->firmantes=0;
                $res=$peticion->save();
                if($res){
                    $res_file=$this->fileUpload($request,$peticion->id);
                    if($res_file){
                        $peticion->file()->associate($res_file);
                        $peticion->save();
                        return redirect()->route('peticiones.listMine');
                    }

                    return back()->withErrors('Error creando peticion')->withInput();
                }
            }catch(\Exception $exception){
                return back()->withErrors($exception->getMessage())->withInput();

            }
            return ;

    }

    public function fileUpload(Request $req, $peticione_id = null){
        $file = $req->file('image');
        $fileModel = new File;
        $fileModel->peticione_id = $peticione_id;
        if ($req->file('image')) {
            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('peticiones', $filename);
            $fileModel->name = $filename;
            $fileModel->file_path = $filename;
            $res = $fileModel->save();
            return $fileModel;
            if ($res) {
                return 0;
            } else {
                return 1;
            }
        }
        return 1;
    }

    public function store2(request $request){

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



        /*n$imagen=$request->file('image');


        /*$nombreI=$imagen->getClientOriginalName();
        $ruta=public_path('img/');
        copy($imagen->getRealPath(),$ruta.$nombreI);

        $imagenB= new File();
        $imagenB['name']=$nombreI;
        $imagenB['file_path']=$ruta;
        $imagenB['peticion_id']=$peticion['id'];
        $imagen->save();*/

        $categoria=Categoria::find($peticion['categoria_id']);
        return view('peticiones.show',compact('peticion','categoria'));

    }
    public function create(){
        $categoria=Categoria::all();
        return view('peticiones.create',compact('categoria'));
    }

    public function show($id){
        $peticion=Peticione::query()->findOrFail($id);
        $categoria=Categoria::find($peticion['categoria_id']);
        return view('peticiones.show',compact('peticion','categoria'));
    }






}
