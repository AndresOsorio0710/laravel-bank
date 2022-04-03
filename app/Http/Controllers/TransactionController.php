<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $transactions = DB::select("SELECT DISTINCT t.id, (SELECT name FROM accounts WHERE id = t.source_account) as source_account,t.source_account as source_account_id,(SELECT name FROM accounts WHERE id = t.target_account) as target_account,t.target_account as target_account_id,t.created_at,t.amount,(SELECT (SELECT id FROM users WHERE id = au.user_id) FROM accounts as au WHERE au.id = t.source_account) as source_id,(SELECT (SELECT id FROM users WHERE id = au.user_id) FROM accounts as au WHERE au.id = t.target_account) as target_id FROM transactions as t LEFT JOIN accounts as a ON t.source_account = a.id OR t.target_account = a.id WHERE a.user_id = ".auth()->user()->id." ORDER BY t.created_at DESC;");
        $my_accounts = Account::where('user_id',auth()->user()->id)->where('is_enabled',1)->orderBy('name','Asc')->get();
        $other_accounts = DB::select("SELECT  id, concat((SELECT concat(last_name,' ',name) as name FROM users WHERE id = acc.user_id),' - ',name) as name, amount, is_enabled, user_id, created_at, updated_at FROM accounts as acc WHERE is_enabled = 1 AND user_id <> ".auth()->user()->id." ORDER BY user_id,name;");
        $data=[
            'transactions'=>$transactions,
            'my_accounts' => $my_accounts,
            'other_accounts' => $other_accounts
        ];
        return view('transaction.index',$data);
    }

}
