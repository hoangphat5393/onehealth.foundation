<?php

namespace App\Http\Requests\Admin\Juridical;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateJuridical extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.juridical.edit', $this->juridical);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'value' => ['required', 'string'],
            // 'slug' => ['sometimes', Rule::unique('juridicals', 'slug')->ignore($this->juridical->getKey(), $this->juridical->getKeyName()), 'string'],
            'status' => ['required', 'boolean'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
