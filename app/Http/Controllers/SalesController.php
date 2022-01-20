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
        $this->repository = new \App\Repositories\SalesRepository;
        $this->service =  new \App\Http\Services\SalesService;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(SalesRequest $request)
    {
        return $this->service->store($request);
    }

    public function updateStatusCancel($id)
    {
        return $this->service->updateStatusCancel($id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
