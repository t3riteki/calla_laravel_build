<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreEnrolledUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::info('StoreEnrolledUserRequest validation triggered', [
            'input' => $this->all()
        ]);
        return [
            'user_id'      => 'nullable|integer|exists:users,id',
            'email'        => 'nullable|email|exists:users,email',
            'classroom_id' => 'required|integer|exists:classrooms,id',
        ];
    }
}
