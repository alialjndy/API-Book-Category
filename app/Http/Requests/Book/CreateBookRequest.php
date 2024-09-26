<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBookRequest extends FormRequest
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
            'title'=>['required','string','max:100'],
            'author'=>['required','string','max:50'],
            'published_at'=>['required','date'],
            'category_id'=>['required','exists:categories,id'],
            'is_active'=>['required','in:0,1']
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(response()->json([
            'status'=>'failed',
            'message'=>'Failed Verification please cofirm the input',
            'errors'=>$validator->errors()
        ],422));
    }
    public function attributes(){
        return [
            'title'=>'Book Title',
            'author'=>'Author Name',
            'published_at'=>'published Date',
            'is_active'=>'status of book'
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'string'=>'The :attribute value must be a string',
            'date'=>'The :attribute must be a date',
        ];
    }
}
