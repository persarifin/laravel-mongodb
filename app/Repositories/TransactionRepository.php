<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;
use App\Http\Resources\TransactionResource;

class TransactionRepository extends BaseRepository
{
    public function __construct() 
    {
        parent::__construct(Transaction::class);
    }

	public function index($request)
	{
		try {
			$this->query = $this->getModel();
			$this->applyCriteria(new SearchCriteria($request));
			$presenter = new DataPresenter(TransactionResource::class, $request);
	
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
		$presenter = new DataPresenter(TransactionResource::class, $request);
	
		return $presenter->render($this->query);
	}
	

	public function destroy($id)
	{
		try{
			$transaction = $this->getModel()->find($id);
			
			if (!$transaction) throw new \Exception("data not found", 400);

			$sales = \App\Models\Sales::find($transaction->sales_id)->update(['status' => "UNPAID"]);
			
			$transaction->delete();

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
