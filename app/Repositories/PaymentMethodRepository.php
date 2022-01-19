<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;

class PaymentMethodRepository extends BaseRepository
{
    public function __construct() 
    {
        parent::__construct(PaymentMethod::class);
    }

	public function index($request)
	{
		try {
			$this->query = $this->getModel();
			$this->applyCriteria(new SearchCriteria($request));

			return $this->renderCollection($request);
		}catch (\Exception $e) {
			response()->json([
				'success' => false,
				'message' => $e->getMessage()
			], 400);
		}
	}

	public function show($id, $request)
	{
		$this->query = $this->getModel()->where('id', $id);
		
		$this->applyCriteria(new SearchCriteria($request));
		
		return $this->render($request);
	}
	
	public function destroy($id)
	{
		try{
			$payment = $this->getModel()->find($id);
			
			if (!$payment) {
				throw new \Exception("data not found", 400);
			}

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
