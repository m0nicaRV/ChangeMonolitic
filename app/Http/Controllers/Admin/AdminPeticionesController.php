<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\File;
use App\Models\Peticione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;

class AdminPeticionesController extends Controller
{

    public function index(){

        $peticiones = Peticione::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.home',compact('peticiones'));
    }

    public function edit(Request $request,$id){
        try{
            $categoria=Categoria::all();
            $peticion=Peticione::findOrFail($id);

        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return view('admin.peticiones.edit',compact('categoria', 'peticion'));
    }

    public function delete($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            if($peticion->firmas()->count() > 0){
                return back()->withErrors('no puedes eliminar peticiones firmadas')->withInput();
            }
            $peticion->delete();
            return redirect()->route('admin.home');
        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function cambiarEstado($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            if($peticion->estado=="aceptada"){
                $peticion->estado="pendiente";
            }else{
                $peticion->estado="aceptada";
            }
            $peticion->save();
        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return redirect()->route('admin.home');
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
                    return redirect()->route('admin.home');
                }
                return back()->withErrors('Error creando peticion')->withInput();
            }
        }catch(\Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();

        }
        return ;}

    public function create(){
        $categoria=Categoria::all();
        $peticion=null;
        return view('admin.peticiones.create',compact('categoria', 'peticion'));
    }

    function update(request $request, $id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            $res=$peticion->update($request->all());
            if($request->file('image')){
                $peticion->file()->delete();
                if($res){
                    $res_file=$this->fileUpload($request,$peticion->id);
                    if($res_file){
                        return redirect()->route('adminpeticiones.show',$id);
                    }
                    return back()->withErrors('Error actualizando peticion')->withInput();
                }
            }

        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return redirect()->route('adminpeticiones.show',$id);
    }

    public function show($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            $categoria=Categoria::find($peticion['categoria_id']);
            return view('admin.peticiones.show',compact('peticion','categoria'));
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }}

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

}
