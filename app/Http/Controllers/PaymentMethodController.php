<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PaymentMethodCollection;

class PaymentMethodController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new App\Repositories\PaymentMethodRepository;
        $this->service =  new App\Http\Services\PaymentMethodService;
    }

    public function index()
    {
        $result = $this->repository->index(Request::all());

        return new PaymentMethodCollection($result);
    }

    public function store(PaymentMethodRequest $request)
    {
        $result = $this->service->store($request);

        return new PaymentMethodResource($result);
    }

    public function update($id, PaymentMethodRequest $request)
    {
        $result = $this->service->update($id, $request);
        
        return new PaymentMethodResource($result);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
