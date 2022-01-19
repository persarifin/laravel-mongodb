<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentExpiredRequest;
use App\Repositories\PaymentExpiredRepository;
use App\Http\Services\PaymentExpiredService;
use App\Http\Resources\PaymentExpiredResource;
use App\Http\Resources\PaymentExpiredCollection;

class PaymentExpiredController extends Controller
{
    protected $repository, $service;

    public function __construct()
    {
        $this->repository = new PaymentExpiredRepository;
        $this->service =  new PaymentExpiredService;
    }

    public function index()
    {
        $result = $this->repository->index(Request::all());

        return new PaymentExpiredCollection($result);
    }

    public function store(PaymentExpiredRequest $request)
    {
        $result = $this->service->store($request);

        return new PaymentExpiredResource($result);
    }

    public function update($id, PaymentExpiredRequest $request)
    {
        $result = $this->service->update($id, $request);

        return new PaymentExpiredResource($result);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
