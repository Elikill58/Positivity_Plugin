<?php

namespace Azuriom\Plugin\Positivity\Requests;

use Azuriom\Http\Requests\Traits\ConvertCheckbox;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => ['required', 'integer', 'min:5'],
            'stats_host' => ['nullable', 'string'],
            'stats_port' => ['nullable', 'integer'],
            'stats_username' => ['nullable', 'string'],
            'stats_password' => ['nullable', 'string'],
            'stats_database' => ['nullable', 'string'],
        ];
    }
}
