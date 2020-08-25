<?php

namespace App\Api\V1\Requests\User;

use Illuminate\Validation\Rule;
use App\Models\User;
use Dingo\Api\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    { 
        return $this->user()->can('update', $this->route('user'));
    }
    
    public function rules()
    {
        return User::rules('update');
    }

}

?>