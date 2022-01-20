<?php

namespace App\Repositories;

use App\Models\Transportation;
use App\Http\Criterias\SearchCriteria;
use Illuminate\Http\Request;
use App\Http\Presenters\DataPresenter;
use App\Http\Resources\TransportationResource;

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
			$presenter = new DataPresenter(TransportationResource::class, $request);
	
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
		$this->query = Transportation::where('_id', $id);
		$presenter = new DataPresenter(TransportationResource::class, $request);
	
		return $presenter->render($this->query);
	
	}
	

	public function destroy($id)
	{
		try{
			$transportation = $this->getModel()->find($id);
			if (!$transportation) throw new \Exception("data not found", 400);

			$salesCount = \App\Models\Sales::where('transportation_id', $transportation->_id)->count();
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
