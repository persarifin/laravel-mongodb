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
		$payload = $request->all();
		$payment = PaymentMethod::create($payload);

		return $this->paymentMethodRepository->show($payment->_id, $request);
	}

	public function update($id, $request)
	{
		$payload = $request->all();
		$payment = PaymentMethod::find($id);

		if (!$payment) {
			throw new \Exception("data not found", 400);
		}
		
		$payment->update($payload);

		return $this->paymentMethodRepository->show($payment->_id, $request);	
	}
}
