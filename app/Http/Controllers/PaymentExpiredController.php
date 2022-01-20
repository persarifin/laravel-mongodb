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

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(PaymentExpiredRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, PaymentExpiredRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
