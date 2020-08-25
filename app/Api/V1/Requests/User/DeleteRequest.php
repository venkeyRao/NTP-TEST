<?php

namespace App\Api\V1\Requests\User;

use Illuminate\Validation\Rule;
use App\Models\User;
use Dingo\Api\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize()
    { 
        return $this->user()->can('delete', $this->route('user'));
    }
    
    public function rules()
    {
        return [];
    }

}

?>