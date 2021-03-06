<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Services\TransactionService;
use App\Http\Resources\TransactionCollection;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new TransactionRepository;
        $this->service =  new TransactionService;
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
