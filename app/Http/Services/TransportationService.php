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
		$payload = $request->all();
		$payload['type'] = $payload['cars'] ? 'CAR' : 'MOTORCYCLE';
		$transportation = \App\Models\Transportation::create($payload);

		if ($payload['cars']) {
			$transportation->car()->create($request['cars']);
		}elseif ($payload['motorcycles']) {
			$transportation->motorcycle()->create($payload['motorcycles']);
		}

		return $this->transportationRepository->show($transportation->_id, $request);
	}

	public function update($id, $request)
	{
		$payload = $request->all();
		$payload['type'] = $payload['cars'] ? 'CAR' : 'MOTORCYCLE';

		$transportation = \App\Models\Transportation::find($id);

		if (!$transportation) throw new \Exception("data not found", 400);
		if($transportation->type != $payload['type']) throw new \Exception("cannot change type", 400);

		if ($payload['cars']) {
			$payload['type'] = 'CAR';
			$transportation->car()->create($payload['cars']);
		}elseif ($payload['motorcycles']) {
			$payload['type'] = 'MOTORCYCLE';
			$transportation->motorcycle()->create($payload['motorcycles']);
		}


		return $this->transportationRepository->show($transportation->_id, $request);
	
	}
}
