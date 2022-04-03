<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $accounts = Account::where('user_id',auth()->user()->id)->where('is_enabled',1)->orderBy('name','Asc')->get();
        $amount = 0;
        foreach($accounts as $account){
            $amount += $account->amount;
        }
        $data = [
            'accounts' => $accounts,
            'amount' => $amount
        ];
        //dd($amount);
        return view('account.index',$data);
    }

    public function store(Request $request){
        $rules=[
            'name'=>'required|min:1|max:20'
        ];

        $message=[
            'name.required'=>'El nombre de la cuenta es requerido.',
            'name.min'=>'El nombre de la cuenta debe tener al menos 1 caracter.',
            'name.max'=>'Solo se permiten hasta 20 caracteres para el nombre de la cuenta.'
        ];

        $validator=Validator::make($request->all(),$rules,$message);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error.')->with('typealert','danger');
        else:
            $new_account = new Account;
            $new_account->name=e($request->name);
            $new_account->user_id=auth()->user()->id;
            if($new_account->save()):
                return redirect()->route('account.index')->with('message','Cuenta creada.')->with('typealert','success');
            endif;
        endif;
    }
}
