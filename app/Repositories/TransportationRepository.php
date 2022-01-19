<?php

namespace App\Repositories;

use App\Models\Transportation;
use App\Http\Criterias\SearchCriteria;
use App\Http\Presenters\DataPresenter;

class TransportationRepository extends BaseRepository
{
    public function __construct() 
    {
        parent::__construct(Transportation::class);
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
			$transportation = $this->getModel()->find($id);
			if (!$transportation) throw new \Exception("data not found", 400);

			$salesCount = Sales::where('sales_id', $transportation->id)->count();
			if ($salesCount > 0 ) throw new \Exception("Delete Fail, cannot delete vehicle has sales", 401);

			$transportation->car()->delete();
			$transportation->motorcycle()->delete();
			$transportation->delete();

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
