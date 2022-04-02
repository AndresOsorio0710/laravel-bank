<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('connect.login');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'identification' => 'required|numeric|digits_between:6,11',
            'password' => 'required|numeric|digits_between:4,4',
        ];

        $message = [
            'identification.required' => 'Su identificación es requerida.',
            'identification.numeric' => 'La identificación solo permite caracteres numericos.',
            'identification.digits_between' => 'La identificación solo permite entre 6 y 11 caracteres.',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.numeric' => 'La contraseña debe ser de tipo númerica.',
            'password.digits_between' => 'La contraseña debe tener 4 caracteres .'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:
            if(Auth::attempt(['identification' => $request->identification, 'password' => $request->password], true)):
                return redirect()->route('home');
            else:
                return back()->with('message', 'Identificación o contraseña incorrecta.')
                    ->with('typealert', 'danger');
            endif;
        endif;
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('home');
    }
}
