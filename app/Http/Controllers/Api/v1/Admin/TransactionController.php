<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\TransactionCollection;
use App\Http\Resources\v1\Admin\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    public function index(Request $request)
    {

        $transaction = "id";
        $desc = "DESC";

        if (isset($request->transaction))
            $order  = $request->transaction;

        if (isset($request->desc))
            $order  = $request->desc;

        $transactions =  Transaction::transactionBy($order, $desc)->paginate(20);

        return new TransactionCollection($transactions);
    }
  
    public function update(Request $request, Transaction $transaction)
    {
      

    $inputs = [
        "is_paid" => $request->is_paid,
        "order_id" => $request->order_id,
        "user_id" => $request->user_id,
        "price" => $request->price,
    ];
    

        $transaction->update($inputs);


        return response([
            "data" => "transaction updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Transaction $transaction)
    {

        return new TransactionResource($transaction);
    }
    public function delete(Transaction $transaction)
    {



        $transaction->delete();
        return response([
            "data" => "transaction deleted successfully",
            "status" => 200
        ], 200);
    }
}
