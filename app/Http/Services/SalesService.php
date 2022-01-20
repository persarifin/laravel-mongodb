<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\SalesRepository;
use App\Repositories\TransportationRepository;
use Carbon\Carbon;

class SalesService extends BaseService
{
	protected $salesRepository, $transportationRepository;
    public function __construct()
    {
        $this->salesRepository = new SalesRepository;
        $this->transportationRepository = new TransportationRepository;
    }

    public function store($request)
	{
		try{
			$payload = $request->all();
			$latestSales = \App\Models\Sales::orderByDesc('id')->first();
			$payload['invoice'] = 'INV'.date('ymdhis'). $latestSales? $latestSales->_id : '01';
			$payload['selling_date'] = Carbon::now()->toDatetimeString;

			$transportation = \App\Models\Transportation::find($payload['transportation_id']);
            $payload['amount'] = ($payload['amount'] * $payload['quantity']);

			if ($payload['tax'] > 0) {
				$payload['amount'] = $payload['amount'] + (($payload['amount'] * $payload['tax'])/100);
			}

			$paymentExpired = \App\Models\PaymentExpired::find($payload['payment_expired_id']);
			$payload['payment_expired_at'] = Carbon::now()->addHours($paymentExpired->hours);
			$payload['user_id'] = \Auth::user()->_id;
			$payload['status'] = "UNPAID"; 
			$sales = create($payload);

			return $this->salesRepository->show($sales->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   	}
	}

	public function updateStatusCancel($id, $request)
	{
		try {
			$sales = \App\Models\Sales::find($id);

			if (!$sales) throw new \Exception("data not found", 404);
			
			$sales->status = 'CANCELED';
			$sales->save();

			return $this->salesRepository->show($sales->_id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}
}
