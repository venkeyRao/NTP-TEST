<?php

namespace App\Api\V1\Requests\User;

use Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Dingo\Api\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function authorize()
    { 
        return true;
    }
    
    public function rules()
    {
        return [
            'status' => ['nullable', Rule::in(User::STATUS_APPROVED, User::STATUS_DISABLED,User::STATUS_PENDING)],
            'zip_code' => ['nullable'],
            'order_by' => ['nullable', Rule::in('desc', 'asc')],
        ];
    }
   
}

?>