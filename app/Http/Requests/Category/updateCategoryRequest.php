<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateCategoryRequest extends FormRequest
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
            'name'=>['nullable','string','max:20'],
            'description'=>['nullable','string','max:255']
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'Failed Verification please confirm the input',
                'errors'=>$validator->errors()
            ],403)
        );
    }
    public function attributes(){
        return[
            'name'=>'category name',
            'description'=>'category description'
        ];
    }
    public function messages(){
        return [
            'string'=>'The :attribute value must be a string',
            'max'=>'The :attribute max length is max'
        ];
    }
}
