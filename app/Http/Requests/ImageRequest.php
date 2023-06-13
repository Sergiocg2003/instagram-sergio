<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
  public function rules(): array
  {
    return match ($this->method()) {
      "POST" => [
        "image_path" => "required|min:2|unique:images",
        "description" => "required|min:10",
      ],
      "PUT" => [
        "description" => "required|min:10",
      ],
    };
  }
}