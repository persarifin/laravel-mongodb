<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentMethodRequest;
use App\Http\Services\PaymentMethodService;
use App\Repositories\PaymentMethodRepository;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PaymentMethodCollection;

class PaymentMethodController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new PaymentMethodRepository;
        $this->service =  new PaymentMethodService;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(PaymentMethodRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, PaymentMethodRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
