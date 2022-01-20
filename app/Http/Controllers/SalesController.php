<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalesRequest;
use App\Http\Resources\SalesResource;
use App\Http\Resources\SalesCollection;
use App\Repositories\SalesRepository;
use App\Http\Services\SalesService;

class SalesController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct()
    {
        $this->repository = new SalesRepository;
        $this->service =  new SalesService;
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
