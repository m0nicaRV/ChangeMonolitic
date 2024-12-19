<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peticione;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use PharIo\Version\Exception;

class AdminUsersController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('admin.users.home',compact('users'));
    }

    public function show($id){
        $user= User::query()->findOrFail($id);
        return view('admin.users.show',compact('user'));

    }

    public function cambiarRol($id){
        try{
            $user=User::query()->findOrFail($id);
            if($user->role_id==0){
                $user->role_id=1;
            }else{
                $user->role_id=0;
            }
            $user->save();
        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return redirect()->route('adminusers.index');
    }

    public function delete($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->route('adminusers.index');
    }


}
