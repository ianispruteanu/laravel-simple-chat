<?php

namespace Pruteanu\InterChat\Http\Requests;

use App\Models\User;
use Dyrynda\Database\Rules\EfficientUuidExists;
use Illuminate\Foundation\Http\FormRequest;
use Pruteanu\InterChat\Classes\CustomRegister;
use Pruteanu\InterChat\Models\Chat;

class ReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'string',
        ];
    }
}
