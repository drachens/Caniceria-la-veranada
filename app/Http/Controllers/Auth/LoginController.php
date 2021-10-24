<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Clientes;
use App\Usuarios;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function login(Request $request){
        $credenciales = $this->validate(request(),[
            'correo'=> 'email:rfc|required|string',
            'password'=>'required|string|min:8|max:255', 
        ]);
        
        $userAdmin = Usuarios::where('correo','=',$request->correo)->first();

        if(!$userAdmin){ //Si el usuario no es un admin, vemos si es cliente.
            $userInfo = Clientes::where('correo','=',$request->correo)->first();

            if(!$userInfo){
                return back()->with('fail','Correo o contraseña incorrecto.')->withInput($credenciales);
            }
            else{
                if(Hash::check($request->password,$userInfo->password)){
                    $request->session()->put('LoggedUser',$userInfo->id);
                    $request->session()->put('type','client');
                    return redirect('/');
                }
                else{
                    return back()->with('fail','Contraseña incorrecta.')->withInput($credenciales);
                }
            }
        }

        else{
            if(Hash::check($request->password,$userAdmin->password)){
                $request->session()->put('LoggedUser',$userAdmin->id);
                $request->session()->put('type',$userAdmin->rol);
                return redirect('/');
            }
            else{
                return back()->with('fail','Contraseña incorrecta.')->withInput($credenciales);
            }

        }

    } 
        
    
    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            session()->pull('type');
            return redirect('ingreso');
        }
    }
}
