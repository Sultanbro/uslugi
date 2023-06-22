<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;
use App\Http\Requests\Service\ServiceUsersRequest;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Services\ServiceServiceInterface;
use App\Models\Service;
use App\Traits\Request\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceController extends Controller
{
    use ApiResponse;
    /**
     * @var ServiceServiceInterface
     */
    private $service;

    /**
     * ServiceController constructor.
     * @param ServiceServiceInterface $service
     */
    public function __construct(ServiceServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index()
    {
        return $this->successResponse(ServiceResource::collection(Service::query()->get()));
    }

    /**
     * Store a newly created resource in storage.
     * @param ServiceRequest $request
     * @return mixed
     */
    public function store(ServiceRequest $request)
    {
        return $this->successResponse(new ServiceResource($this->service->store($request->validated())));
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        if ($serviceModel = Service::query()->firstWhere('id', $id)) {
            return $this->successResponse(new ServiceResource($serviceModel));
        }
        return $this->errorResponse('id not found', 404);
    }

    /**
     * Update the specified resource in storage.
     * @param ServiceRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(ServiceRequest $request, int $id)
    {
        if (Service::query()->firstWhere('id', $id)) {
            return $this->successResponse(new ServiceResource($this->service->update($request->validated(), $id)));
        }
        return $this->errorResponse('id not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        if ($serviceModel = Service::query()->firstWhere('id', $id)) {
            return $this->successResponse($serviceModel->delete());
        }
        return $this->errorResponse('id not found', 404);
    }

}
