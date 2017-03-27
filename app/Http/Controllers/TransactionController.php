<?php
namespace App\Http\Controllers;

use App\Http\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepo;

    public function __construct(TransactionRepository $transactionRepo){
        $this->transactionRepo = $transactionRepo;
        $this->middleware('validation', ['only' => ['save']]);
    }

    public function save(Request $request){
        /*if($request->is('api/v1/transactions')){
            dd('ok');
        }
        */

        //dd($request->method());
        //dd($request->url());
        //dd($request['product_id']);
        return $this->transactionRepo->setNewTransaction($request->all());
    }
}