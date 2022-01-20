<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\PaymentExpired;
use App\Repositories\PaymentExpiredRepository;
use Carbon\Carbon;

class PaymentExpiredService extends BaseService
{
    protected $paymentExpiredRepository;
    public function __construct()
    {
        $this->paymentExpiredRepository = new PaymentExpiredRepository;
    }

    public function store($request)
	{
		try{
			$payload = $request->all();
			$payment = PaymentExpired::create($payload);

			return $this->paymentExpiredRepository->show($payment->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}

	public function update($id, $request)
	{
		try{
			$payload = $request->all();
			$payment = PaymentExpired::find($id);

			if (!$payment) {
				throw new \Exception("data not found", 400);
			}
			
			$payment->update($payload);

			return $this->paymentExpiredRepository->show($payment->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
		
	}
}
