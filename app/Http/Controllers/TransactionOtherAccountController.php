<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionOtherAccountController extends Controller
{
    public function create(){
        $my_accounts = Account::where('user_id',auth()->user()->id)->where('is_enabled',1)->orderBy('name','Asc')->get();
        $other_accounts = DB::select("SELECT  id, concat((SELECT concat(last_name,' ',name) as name FROM users WHERE id = acc.user_id),' - ',name) as name, amount, is_enabled, user_id, created_at, updated_at FROM accounts as acc WHERE is_enabled = 1 AND user_id <> ".auth()->user()->id." ORDER BY user_id,name;");
        $data = [
            'my_accounts' => $my_accounts,
            'other_accounts' => $other_accounts
        ];
        return view('transaction.other_account.index', $data);
    }

    
}
