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
		
			return $this->query;
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

		return $this->query; 
	}
	public function store($request)
	{
		try{
			$payload = $request->all();
			$transaction = $this->getModel()->create($payload);

			return $this->show($transaction->id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}

	public function destroy($id)
	{
		try{
			$transaction = $this->getModel()->findOrFail($id)->delete();

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
