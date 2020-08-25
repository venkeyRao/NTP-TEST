<?php

namespace App\Api\V1\Resources;

use Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        return  [
            'id' => $this->_id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'role' => $this->role,
            'status' => $this->status,
            'description' => $this->description,
            'category' => $this->category,
            'zip_code' => $this->zip_code,
            'profile_image' => $this->profile_image != null ? asset(Storage::url($this->profile_image)) : '',
            'gallery_images' => $this->gallery_images != null ? collect($this->gallery_images)->map(function($file) {
                return asset(Storage::url($file));
            }): '',
        ];

    }
}
