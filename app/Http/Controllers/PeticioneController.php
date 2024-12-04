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
                        return redirect()->route('peticiones.mine');
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
    public function firmar(Request $request, $id)
    {
        try {
            $peticion = Peticione::findOrFail($id);
            $user = Auth::user();
            $firmas = $peticion->firmas;
            foreach ($firmas as $firma) {
                if ($firma->id == $user->id) {
                    return back()->withError( "Ya has firmado esta petición")->withInput();
                }
            }
            $user_id = [$user->id];
            $peticion->firmas()->attach($user_id);
            $peticion->firmantes = $peticion->firmantes + 1;
            $peticion->save();
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
            }
        return redirect()->back();
        }

    public function peticionesFirmadas(Request $request){
        try {
            $id = Auth::id();
            $usuario = User::findOrFail($id);
            $peticiones = $usuario->firmas;
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
        return view('peticiones.index', compact('peticiones'));
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
