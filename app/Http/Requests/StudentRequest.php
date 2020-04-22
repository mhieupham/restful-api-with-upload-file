<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;
class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'image'=>'mimes:jpeg,png,jpg|max:10000',
            'email'=>'email'
        ];
    }
    public function messages()
    {
        return[
            'first_name.required'=>'Bạn cần điền tên của bạn',
            'last_name.required'=>'Bạn cần điền họ của bạn',
            'image.mimes'=>'File của bạn không phải là hình ảnh',
            'image.max'=>'File của bạn có kích thước lớn hơn 10000kb',
            'email.email'=>'Email không đúng định dạng'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $error = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $error,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
