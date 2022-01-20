<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\SalesRepository;
use Carbon\Carbon;

class TransactionService extends BaseService
{
    protected $transactionRepository;

    public function __construct()
    {       
        $this->salesRepository = new SalesRepository;        
    }

    public function store($request)
	{
		try{
			$payload = $request->all();
            $sales = \App\Models\Sales::find($payload['sales_id']);
            if ($sales->payment_expired_at >= Carbon::now()->toDateTimeString) {
                $sales->status = "FAILED";
                $sales->save();
                throw new \Exception("payment failed, payment deadline has expired", 401);
            }

            if ((int)$payload['amount'] !== (int)$sales->amount) {
                throw new \Exception("payment failed, amount must be same with total amount of sales", 400);
            }
            
            $payload['transaction_date'] = Carbon::now()->toDateTimeString;
			$transaction = $sales->transaction()->create($payload);
            $sales->status = "PAID";
            $sales->save();

            $transportation = \App\Models\Transportation::find($sales->transportation_id);
            $transportation->stock -= $sales->quantity;
            $transportation->save();
            
			return $this->transactionRepository->show($transaction->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}
}
