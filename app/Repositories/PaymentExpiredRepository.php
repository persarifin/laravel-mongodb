<?php

namespace App\Repositories;

use App\Models\PaymentExpired;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;
use App\Http\Resources\PaymentExpiredResource;

class PaymentExpiredRepository extends BaseRepository
{
    public function __construct() 
    {
        parent::__construct(PaymentExpired::class);
    }

	public function index($request)
	{
		try {
			$this->query = $this->getModel();
			$this->applyCriteria(new SearchCriteria($request));
			$presenter = new DataPresenter(PaymentExpiredResource::class, $request);
	
			return $presenter
				->preparePager()
				->renderCollection($this->query);

		}catch (\Exception $e) {
			response()->json([
				'success' => false,
				'message' => $e->getMessage()
			], 400);
		}
	}

	public function show($id, $request)
	{
		$this->query = $this->getModel()->where('_id', $id);
		$presenter = new DataPresenter(PaymentExpiredResource::class, $request);
		
		return $presenter->render($this->query);
	}
	
	public function destroy($id)
	{
		try{
			$payment = $this->getModel()->find($id);
			
			if (!$payment) throw new \Exception("data not found", 400);

			$sales = \App\Models\Sales::where('sales_id', $payment->_id)->count();

			if ($sales > 0) throw new \Exception("delete failed, this payment expired used by sales", 400);

			$payment->delete();

			return response()->json([
				'success' => true,
				'message' => 'data already deleted'
			], 200);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}
}
