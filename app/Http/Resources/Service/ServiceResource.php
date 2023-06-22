<?php

namespace App\Http\Resources\Service;

use App\Http\Resources\Service\Type\TypeResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'types' => TypeResource::collection($this->types),
            'users' => UserResource::collection($this->users),
        ];
    }
}
