<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransportationRequest;
use App\Http\Resources\TransportationResource;
use App\Http\Resources\TransportationCollection;

class TransportationController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new App\Repositories\TransportationRepository;
        $this->service =  new App\Http\Services\TransportationService;
    }

    public function index()
    {
        $result = $this->repository->index(Request::all());

        return new TransportationCollection($result);
    }

    public function store(TransportationRequest $request)
    {
        $result = $this->service->store($request);

        return new TransportationResource($result);
    }

    public function update($id, TransportationRequest $request)
    {
        $result = $this->service->update($id, $request);
        
        return new TransportationResource($result);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}