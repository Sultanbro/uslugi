<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\TypeRequest;
use App\Http\Resources\Service\Type\TypeResource;
use App\Models\Type;
use App\Traits\Request\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Uuid\Type\Integer;

class TypeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index()
    {
        return $this->successResponse(TypeResource::collection(Type::query()->get()));
    }

    /**
     * Store a newly created resource in storage.
     * @param TypeRequest $request
     * @return mixed
     */
    public function store(TypeRequest $request)
    {
        return $this->successResponse(new TypeResource(Type::query()->create($request->validated())));
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        if ($typeModel = Type::query()->firstWhere('id', $id)) {
            return $this->successResponse(new TypeResource($typeModel));
        }
        return $this->errorResponse('id not found', 404);
    }

    /**
     * Update the specified resource in storage.
     * @param TypeRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(TypeRequest $request, int $id)
    {
        if ($typeModel = Type::query()->firstWhere('id', $id)) {
            $typeModel->update($request->validated());
            return $this->successResponse(new TypeResource($typeModel));
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
        if ($typeModel = Type::query()->firstWhere('id', $id)) {
            return $this->successResponse($typeModel->delete());
        }
        return $this->errorResponse('id not found', 404);
    }
}
