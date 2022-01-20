<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\PaymentMethodRepository;
use App\Models\PaymentMethod;

class PaymentMethodService extends BaseService
{
    protected $paymentMethodRepository;

    public function __construct()
    {
        $this->paymentMethodRepository = new PaymentMethodRepository;
    }

    public function store($request)
	{
		try{
			$payload = $request->all();
			$payment = PaymentMethod::create($payload);

			return $this->paymentMethodRepository->show($payment->_id, $request);
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
			$payment = PaymentMethod::find($id);

			if (!$payment) {
				throw new \Exception("data not found", 400);
			}
			
			$payment->update($payload);

			return $this->paymentMethodRepository->show($payment->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }	
	}
}
