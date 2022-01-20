<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\SalesRepository;
use App\Repositories\TransportationRepository;

class SalesService extends BaseService
{
	protected $salesRepository;
	protected $transportationRepository;
    public function __construct()
    {
        $this->salesRepository = new SalesRepository;
        $this->transportationRepository = new TransportationRepository;
    }

    public function store($request)
	{
		$payload = $request->all();
		$latestSales = \App\Models\Sales::orderBy('_id','DESC')->first();
		$payload['invoice'] = 'INV'.date('ymdhis'). ($latestSales? $latestSales->_id : '01');
		$payload['selling_date'] = date('Y-m-d H:i:s');

		$transportation = \App\Models\Transportation::find($payload['transportation_id']);
		$payload['amount'] = ($transportation->price * $payload['quantity']);
		
		if (!empty($payload['tax']) && $payload['tax'] > 0) {
			$payload['amount'] = $payload['amount'] + (($payload['amount'] * $payload['tax'])/100);
		}
		
		$paymentExpired = \App\Models\PaymentExpired::find($payload['payment_expired_id']);
		$payload['payment_expired_at'] = date('Y-m-d H:i:s', strtotime('+5 hours'));
		$payload['user_id'] = \Auth::user()->_id;
		$payload['status'] = "UNPAID"; 
		$sales = \App\Models\Sales::create($payload);

		return $this->salesRepository->show($sales->_id, $request);
	}

	public function updateStatusCancel($id, $request)
	{
		$sales = \App\Models\Sales::find($id);

		if (!$sales) throw new \Exception("data not found", 404);
		
		$sales->status = 'CANCELED';
		$sales->save();

		return $this->salesRepository->show($sales->_id, $request);
	}
}
