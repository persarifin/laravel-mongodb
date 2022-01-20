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
		$payload['type'] = $request->filled('cars') ? 'CAR' : 'MOTORCYCLE';
		$transportation = \App\Models\Transportation::create($payload);

		if ($request->filled('cars')) {
			$transportation->car()->create($payload['cars']);
		}elseif ($request->filled('motorcycles')) {
			$transportation->motorcycle()->create($payload['motorcycles']);
		}

		return $this->transportationRepository->show($transportation->_id, $request);
	}

	public function update($id, $request)
	{
		$payload = $request->all();
		$payload['type'] = $request->filled('cars') ? 'CAR' : 'MOTORCYCLE';

		$transportation = \App\Models\Transportation::find($id);

		if (!$transportation) throw new \Exception("data not found", 400);
		if($transportation->type != $payload['type']) throw new \Exception("cannot change type", 400);

		$transportation->car()->delete();
		$transportation->motorcycle()->delete();
		if ($request->filled('cars')) {
			$transportation->car()->create($payload['cars']);
		}elseif ($request->filled('motorcycles')) {
			$transportation->motorcycle()->create($payload['motorcycles']);
		}
		
		$transportation->update($payload);

		return $this->transportationRepository->show($transportation->_id, $request);
	
	}
}
