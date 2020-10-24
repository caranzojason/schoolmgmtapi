<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //billMasterId','billDetailNo','amountPaid','totalDetailAmountPaid','amountchange
    public function saveTransaction(Request $request)
    {
            $transaction = new Transaction();
            $transaction->billMasterId =  $request->billMasterId;
            $transaction->billDetailNo =  $request->billDetailNo;
            $transaction->amountPaid =  $request->amountPaid;
            $transaction->totalDetailAmountPaid =  $request->totalDetailAmountPaid;
            $transaction->amountchange =  $request->amountChange;
            $transaction->save();

            return response()->json([$transaction
            ], 201);
    }
}
