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
			$payload['type'] = $payload['cars'] ? 'CAR' : 'MOTORCYCLE';
			$transportation = \App\Models\Transportation::create($payload);

			if ($payload['cars']) {
				$transportation->car()->create($request['cars']);
			}elseif ($payload['motorcycles']) {
				$transportation->motorcycle()->create($payload['motorcycles']);
			}

			return $this->transportationRepository->show($transportation->_id, $payload);
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
			$transportation = \App\Models\Transportation::find($id);

            if (!$transportation) throw new \Exception("data not found", 400);

			if ($payload['car']) {
				$payload['type'] = 'CAR';
				$transportation->car()->create($payload);
			}elseif ($payload['motorcycle']) {
				$payload['type'] = 'MOTORCYCLE';
				$transportation->motorcycle()->create($payload);
			}

			$payload['relations'] = ['car','motorcycle'];

			return $this->transportationRepository->show($transportation->_id, $payload);
		
		}catch (\Exception $e) {
			response()->json([
			   'success' => false,
			   'message' => $e->getMessage()
		   ], 400);
	   }
	}
}
