<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Faker\Guesser\Name;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        
        $transactions=null;
        if ($request->get('name')){
            $transactions = Transaction::where('name','like','%'.$request->get('name').'%');
        }
        if ($request->get('date')){
            $date= Carbon::parse($request->get('date'));
            $startdate = $date->copy()->startOfDay();
            $enddate = $date->copy()->endOfDay();    
            $transactions = Transaction::whereBetween('date',[ $startdate,$enddate ]);
        }
        if (auth()->user()->hasRole('guest')){
            $now = Carbon::now();
            $startdate = $now->copy()->startOfDay();
            $enddate = $now->copy()->endOfDay();
            
            if (is_null($transactions)){
                $transactions = Transaction::whereBetween('date',[ $startdate,$enddate ])
                ->paginate();
            }else{
                $transactions = $transactions->whereBetween('date',[ $startdate,$enddate ])
                ->paginate();
            } 
        }else{
            if (is_null($transactions)){
                $transactions = Transaction::paginate();
            }else{
                $transactions = $transactions->paginate();
            }
        }
        return view("transactions.index",[
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request )
    {
        $validateddata = $request->validate([
            'name'=>'required|string',
            'date'=>'required',
            'quantity'=>'required|min:1',
            'price'=>'required',
        ]);
        Transaction::create($validateddata);
        return redirect()->route('transactions.index');

    }

    public function edit($id)
    {
        $transaction=Transaction::findOrFail($id);
        return view("transactions.edit",[
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request,$id)
    {
        $validateddata = $request->validate([
            'name'=>'required|string',
            'date'=>'required',
            'quantity'=>'required|min:1',
            'price'=>'required',
        ]);
        Transaction::findOrFail($id)->update($validateddata);
        return redirect()->route('transactions.index');
    }

    public function delete($id)
    {
        $transaction=Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}
