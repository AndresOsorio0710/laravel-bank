<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionOtherAccountController extends Controller
{
    private function validateTransaction($source_account_id,$target_account_id,$amount){
        $source_account=Account::find($source_account_id);
        $target_account=Account::find($target_account_id);
        $data=[false,''];
        if($source_account->user_id != auth()->user()->id):
            $data[0]=true;
            $data[1]='La cuenta de origen no pertenece al usuario actual.';
            return $data;
        endif;
        if(!$source_account->is_enabled):
            $data[0]=true;
            $data[1]='La cuenta de origen no está habilitada.';
            return $data;
        endif;
        if(!$target_account->is_enabled):
            $data[0]=true;
            $data[1]='La cuenta de destino no está habilitada.';
            return $data;
        endif;
        if($target_account->user_id == auth()->user()->id):
            $data[0]=true;
            $data[1]='La cuenta de destino pertenece al usuario actual.';
            return $data;
        endif;
        if($amount <= 0):
            $data[0]=true;
            $data[1]='El monto debe ser superio a $0,00.';
            return $data;
        endif;
        if($source_account->amount<$amount):
            $data[0]=true;
            $data[1]='La cuenta origen no tiene saldo sufuciente para realizar la operación.';
            return $data;
        endif;
        if($target_account->id == $source_account->id):
            $data[0]=true;
            $data[1]='La cuenta de origen debe ser diferente de la cuenta destino.';
            return $data;
        endif;
        return $data;
    }

    private function transfer($source_account_id,$target_account_id,$amount){
        $source_account=Account::find($source_account_id);
        $target_account=Account::find($target_account_id);
        $source_account->amount-=$amount;
        $target_account->amount+=$amount;
        $source_account->save();
        $target_account->save();
    }

    public function create(){
        $my_accounts = Account::where('user_id',auth()->user()->id)->where('is_enabled',1)->orderBy('name','Asc')->get();
        $other_accounts = DB::select("SELECT  id, concat((SELECT concat(last_name,' ',name) as name FROM users WHERE id = acc.user_id),' - ',name) as name, amount, is_enabled, user_id, created_at, updated_at FROM accounts as acc WHERE is_enabled = 1 AND user_id <> ".auth()->user()->id." ORDER BY user_id,name;");
        $data = [
            'my_accounts' => $my_accounts,
            'other_accounts' => $other_accounts
        ];
        return view('transaction.other_account.index', $data);
    }

    public function store(Request $request){
        $rules=[
            'source_account'=>'required|numeric',
            'target_account'=>'required|numeric',
            'amount'=>'required|min:0'
        ];

        $message=[
            'source_account.required'=>'Se requiere una cuenta de origen.',
            'source_account.numeric'=>'Seleccione la cuenta de origen.',
            'target_account.required'=>'Se requiere una cuenta de destino.',
            'target_account.numeric'=>'Seleccione la cuenta de destino.',
            'amount.required'=>'Se requiere un valor a transferir',
            'amount.min'=>'El valor a transferir debe ser mayor a 0.'
        ];

        $validator=Validator::make($request->all(),$rules,$message);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error.')->with('typealert','danger');
        else:
            $is_valid= self::validateTransaction($request->source_account,$request->target_account,$request->amount);
            if($is_valid[0]):
                return back()->withErrors($validator)->with('message',$is_valid[1])->with('typealert','danger');
            else:
                $new_transaction = new Transaction;
                $new_transaction->source_account=$request->source_account;
                $new_transaction->target_account=$request->target_account;
                $new_transaction->amount=$request->amount;
                $new_transaction->code= $new_transaction->source_account .'-'. str_pad(rand(1,1000), 4, "0", STR_PAD_LEFT).'-'.$new_transaction->target_account;
                if($new_transaction->save()):
                    self::transfer($new_transaction->source_account,$new_transaction->target_account,$new_transaction->amount);
                    return redirect()->route('transaction_own_account.index')->with('message','Transferencia Exitosa - Cod:'.$new_transaction->code.'.')->with('typealert','success');
                endif;
            endif;
        endif;
    }
}
