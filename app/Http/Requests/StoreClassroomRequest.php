<?php

namespace App\Http\Requests;

use App\Models\Classroom;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class StoreClassroomRequest extends FormRequest
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
        return [
            'name'=>'required|string|unique:classrooms,name',
            'description'=>'nullable|string|max:255',
            'code'=>'nullable|string|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
{
    // Log the error messages
    Log::error('Validation failed', [
        'errors' => $validator->errors()->toArray(),
        'input' => $this->all(),   // optional: log the submitted data
        'user_id' => auth()->id(),
    ]);

    parent::failedValidation($validator);
}
}
