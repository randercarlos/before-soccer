<?php

namespace App\Http\Requests;

use App\Models\Card;
use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class CardFormRequest extends FormRequest
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
            'type' => ['required', 'in:Y,R'],
            'match_id' => ['required', 'integer', 'exists:' . Match::class . ',id'],
            'team_id' => ['required', 'integer', 'exists:' . Team::class . ',id'],
            'player_id' => ['required', 'integer', 'exists:' . Player::class . ',id'],
        ];
    }
}
