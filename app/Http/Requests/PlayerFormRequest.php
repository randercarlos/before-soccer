<?php

namespace App\Http\Requests;

use App\Models\Player;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayerFormRequest extends FormRequest
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
            'name' => ['required', Rule::unique('players')->ignore($this->player)],
            'cpf' => ['required', 'size:14', Rule::unique('players')->ignore($this->player)],
            'shirt_number' => ['required', 'integer', 'min:1'],
            'team_id' => ['required', 'integer', 'exists:' . Player::class . ',id'],
        ];
    }
}
