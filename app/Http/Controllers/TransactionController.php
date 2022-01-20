<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

class TransactionController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new \App\Repositories\TransactionRepository;
        $this->service =  new \App\Http\Services\TransactionService;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(TransactionRequest $request)
    {
        return $this->service->store($request);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
