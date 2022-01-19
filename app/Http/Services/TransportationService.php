<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Repositories\TransportationRepository;

class TransportationService extends BaseService
{
	protected $transportationRepository;

	public function __construct()
	{
		$this->transportationRepository = new TransportationRepository;
	}

    public function store($request)
	{
		try{
			$payload = $request->all();
			
			$transportation = $this->transportationRepository->getModel()->create($payload);

			if ($payload['car']) {
				$transportation->car()->create($payload);
			}elseif ($payload['motorcycle']) {
				$transportation->motorcycle()->create($payload);
			}

			$payload['relations'] = ['car','motorcycle'];

			return $this->transportationRepository->show($transportation->id, $payload);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}

	public function update($id, $request)
	{
		try{
			$payload = $request->all();
			$transportation = $this->getModel()->find($id);

            if (!$transportation) throw new \Exception("data not found", 400);

			if ($payload['car']) {
				$payload['type'] = 'CAR';
				$transportation->car()->create($payload);
			}elseif ($payload['motorcycle']) {
				$payload['type'] = 'MOTORCYCLE';
				$transportation->motorcycle()->create($payload);
			}

			$payload['relations'] = ['car','motorcycle'];

			return $this->transportationRepository->show($transportation->id, $payload);
		

			return $this->show($transportation->id, $request);
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}
}
