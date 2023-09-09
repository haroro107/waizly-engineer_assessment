<?php

namespace App\Http\Requests;

use App\Http\Transformers\Result;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeRequest extends FormRequest
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

   protected function failedValidation(Validator $validator)
   {
      if ($validator->fails()) {
         throw new HttpResponseException(
            Result::error($validator->errors(), 'Pastikan Semua Field Telah Diisi Dengan Benar.')
         );
      }
   }
   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      $commonRules = [
         'name' => 'string|max:255',
         'job_title' => 'string|max:255',
         'salary' => 'numeric|min:0',
         'department' => 'string|max:255',
         'joined_date' => 'date',
      ];

      return ($this->method() === 'POST')
         ? array_merge($commonRules, [
            'name' => 'required|' . $commonRules['name'],
            'job_title' => 'required|' . $commonRules['job_title'],
            'salary' => 'required|' . $commonRules['salary'],
            'department' => 'required|' . $commonRules['department'],
            'joined_date' => 'required|' . $commonRules['joined_date'],
         ])
         : $commonRules;
   }

   public function messages()
   {
      return [
         'name.required' => 'The name field is required.',
         'salary.min' => 'The salary must be a positive number.',
      ];
   }
}
