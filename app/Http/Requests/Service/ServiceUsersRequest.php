<?php

namespace App\Http\Requests\Service;

use App\Http\Resources\User\UserResource;
use Illuminate\Foundation\Http\FormRequest;

class ServiceUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'users' => 'array',
        ];
    }
}
