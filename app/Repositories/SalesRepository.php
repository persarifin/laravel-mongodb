<?php

namespace App\Repositories;

use App\Models\Sales;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;

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
			$sales = $this->getModel()->find($id);

			if (!$sales) {
				throw new \Exception("data not found", 400);
			}

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
