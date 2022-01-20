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
		$payload = $request->all();
		$payment = PaymentExpired::create($payload);

		return $this->paymentExpiredRepository->show($payment->_id, $request);
	}

	public function update($id, $request)
	{
		$payload = $request->all();
		$payment = PaymentExpired::find($id);

		if (!$payment) {
			throw new \Exception("data not found", 400);
		}
		
		$payment->update($payload);

		return $this->paymentExpiredRepository->show($payment->_id, $request);
		
	}
}
