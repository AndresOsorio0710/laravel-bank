<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('connect.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules =[
            'identification' => 'required|numeric|unique:users|digits_between:6,11',
            'name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|numeric|digits_between:4,4',
            'password_confirmation' => 'required|same:password'
        ];

        $message = [
            'identification.required' => 'Su identificación es requerida.',
            'identification.numeric' => 'La identificación solo permite caracteres numericos.',
            'identification.unique' => 'Ya existe un usuario registrado con esta identificación.',
            'identification.digits_between' => 'La identificación solo permite entre 6 y 11 caracteres.',
            'name.required' => 'Su nombre es requerido.',
            'name.max' => 'El nombre permite hasta 50 caracteres.',
            'last_name.required' => 'Su apellido es requerido.',
            'last_name.max' => 'El apellido permite hasta 50 caracteres.',
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato tde correo electrónico es invalido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.numeric' => 'La contraseña debe ser de tipo númerica.',
            'password.digits_between' => 'La contraseña debe tener 4 caracteres .',
            'password_confirmation.required' => 'Es necesario confirmar la contraseña.',
            'password_confirmation.digits_between' => 'La confirmacionde la contraseña debe tener 4 caracteres c.',
            'password_confirmation.same' => 'Las contraseñas no coinciden.'
        ];

        $validator = Validator::make($request->all(),$rules, $message);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un erros')->with('typealert', 'danger');
        else:
            $new_user = new User;      
            $new_user->identification = e($request->identification); 
            $new_user->name = e($request->name);
            $new_user->last_name = e($request->last_name);
            $new_user->email = e($request->email);
            $new_user->password = Hash::make($request->password);
            if($new_user->save()):
                return redirect()->route('login.index')->with('message','Su usuario se creo con exito, ahora puede iniciar sessión.')->with('typealert','success');
            endif;
        endif;
    }
}
