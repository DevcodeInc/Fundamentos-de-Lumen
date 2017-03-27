<?php
namespace App\Http\Repositories;

use App\Http\Entities\Transaction;
use App\Http\Entities\TransactionDetails;
use Mockery\CountValidator\Exception;

class TransactionRepository
{
    private $status = 200;
    private $data = '';

    public function setNewTransaction($params){
        try{
            app('db')->transaction(function() use($params){

                $transaction = new Transaction;
                $transaction->user_id = $params['user_id']; //usuario
                $transaction->status  = "0"; //pendiente
                $transaction->save();

                $detail = new TransactionDetails;
                $detail->product_id = $params['product_id'];

                $transaction->transaction_details()->save($detail);
                $this->data   = $transaction;

                app('log')->info("Transaction ok: {$this->data}");
            }, 2);

        } catch (Exception $exception){
            app('log')->error("Transaction failed: {$exception->getMessage()}");
            $this->status = 201;
        }

        return response()->json(['data' => $this->data], $this->status);
    }
}