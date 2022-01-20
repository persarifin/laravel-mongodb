<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class TransactionService extends BaseService
{
    protected $transactionRepository;

    public function __construct()
    {       
        $this->transactionRepository = new TransactionRepository;        
    }

    public function store($request)
	{
        $payload = $request->all();
        $sales = \App\Models\Sales::find($payload['sales_id']);

        // if( $sales->status !== "UNPAID") throw new \Exception("payment failed, this sales status not in UNPAID", 401);

        if ($sales->payment_expired_at < date('Y-m-d H:i:s')) {
            $sales->status = "FAILED";
            $sales->save();
            throw new \Exception("payment failed, payment deadline has expired", 401);
        }

        if ((int)$payload['amount'] !== (int)$sales->amount) {
            throw new \Exception("payment failed, amount must be same with total amount of sales", 400);
        }
        
        $payload['transaction_date'] =date('Y-m-d H:i:s');
        $transaction = $sales->transaction()->create($payload);
        $sales->status = "PAID";
        $sales->save();

        $transportation = \App\Models\Transportation::find($sales->transportation_id);
        $transportation->stock -= $sales->quantity;
        $transportation->save();
        
        return $this->transactionRepository->show($transaction->_id, $request);
    
	}
}
