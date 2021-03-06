<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransportationRequest;
use App\Http\Resources\TransportationResource;
use App\Http\Resources\TransportationCollection;
use App\Repositories\TransportationRepository;
use App\Http\Services\TransportationService;

class TransportationController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new TransportationRepository;
        $this->service =  new TransportationService;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(TransportationRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, TransportationRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}