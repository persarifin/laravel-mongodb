<?php

namespace App\Repositories;

use App\Models\Sales;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;
use App\Http\Resources\SalesResource;

class SalesRepository extends BaseRepository
{
    public function __construct() 
    {
        parent::__construct(Sales::class);
    }

	public function index($request)
	{
		try {
			$this->query = $this->getModel()->with(['transaction','user','transportation.car','transportation.motorcycle']);
			$this->applyCriteria(new SearchCriteria($request));
			$presenter = new DataPresenter(SalesResource::class, $request);
	
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
		$presenter = new DataPresenter(SalesResource::class, $request);
		
		return $presenter->render($this->query); 
	}
	

	public function destroy($id)
	{
		try{
			$sales = $this->getModel()->find($id);

			if (!$sales) throw new \Exception("data not found", 400);

			$sales->transaction()->delete();
			$sales->delete();

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
