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
        $this->repository = new App\Repositories\TransactionRepository;
        $this->service =  new App\Http\Services\TransactionService;
    }

    public function index()
    {
        $result = $this->repository->index(Request::all());

        return new TransactionCollection($result);
    }

    public function store(TransactionRequest $request)
    {
        $result = $this->service->store($request);

        return new TransactionResource($result);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
