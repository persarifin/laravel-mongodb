<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalesRequest;
use App\Http\Resources\SalesResource;
use App\Http\Resources\SalesCollection;

class SalesController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new App\Repositories\SalesRepository;
        $this->service =  new App\Http\Services\SalesService;
    }

    public function index()
    {
        $result = $this->repository->index(Request::all());

        return new SalesCollection($result);
    }

    public function store(SalesRequest $request)
    {
        $result = $this->service->store($request);

        return new SalesResource($result);
    }

    public function updateStatusCancel($id)
    {
        $result = $this->service->updateStatusCancel($id);
        
        return new SalesResource($result);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
