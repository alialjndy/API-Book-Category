<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updatedBookRequest extends FormRequest
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
            'title'=>['nullable','string','max:255'],
            'author'=>['nullable','string','max:100'],
            'published_at'=>['nullable','date'],
            'is_active'=>['required','boolean'],
            'category_id'=>['nullable','exists:categories,id']
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'Failed Verification please confirm the input',
                'errors'=>$validator->errors()
            ],422)
        );
    }
    public function attributes()
    {
        return [
            'title'=>'Book Title',
            'author'=>'Author Name',
            'published_at'=>'published Date',
            'is_active'=>'is Active',
            'category_id'=>'Category ID',
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'string'=>'The :attribute field must be a string',
            'boolean'=>'The :attribute field must in 0 or 1',
        ];
    }
}
