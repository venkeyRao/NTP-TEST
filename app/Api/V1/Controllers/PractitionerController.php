<?php

namespace App\Api\V1\Controllers;

use Log;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Api\V1\Resources\UserResource;
use App\Api\V1\Controllers\Controller;
use App\Api\V1\Requests\User\{ListRequest, CreateRequest, ViewRequest, UpdateRequest, DeleteRequest};

class PractitionerController extends Controller
{
    public function index(ListRequest $request) 
    {
       $practitioners = User::where('role', User::ROLE_PRACTITIONER)->when($request->filled('name'), function($query) use($request){
                            $query->where('name', 'like', '%'.$request->name.'%');
                        })->when($request->filled('zip_cpde'), function($query) use($request){
                            $query->where('zip_cpde', $request->zip_cpde);
                        })->when($request->filled('status'), function($query) use($request){
                            $query->where('status',$request->status);
                        })->when($request->filled('category'), function($query) use($request){
                            $query->where('category',$request->category);
                        });

        if($request->filled('order_by')){
            $practitioners->orderBy('created_at', $request->order_by);
        }else{
            $practitioners->orderBy('created_at');
        }

        return UserResource::collection($practitioners->paginate($request->get('page_size')));  
    }

    public function store(CreateRequest $request)
    {
        $user = new User();
        $user->fill($request->all()); 
        $user->role= User::ROLE_PRACTITIONER;
        $user->password = Hash::make($request->password);
        $user->save();
        if(!empty($request->file('profile_image'))){
            $user->profile_image = upload_file($request->file('profile_image'), 'user/'.$user->_id.'/profile_image');
        } 
        if($request->has('gallery_images')){
            $images = [];
            foreach($request->gallery_images as $document){
                $document_path = upload_file($document,'user/'.$user->_id.'/gallery_images'); 
                array_push($images, $document_path);     
            }
            if($user->gallery_images == null){
                $user->gallery_images = $images;
            }else{
                $user->gallery_images = array_merge($images, $user->gallery_images);
            }
        }   
        $user->save();
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());

        if(!empty($request->file('profile_image'))){
            $user->profile_image = upload_file($request->file('profile_image'), 'user/'.$user->_id.'/profile_image');
        } 

        if($request->has('gallery_images')){
            $images = [];
            foreach($request->gallery_images as $document){
                $document_path = upload_file($document,'user/'.$user->_id.'/gallery_images'); 
                array_push($images, $document_path);     
            }
            if($user->gallery_images == null){
                $user->gallery_images = $images;
            }else{
                $user->gallery_images = array_merge($images, $user->gallery_images);
            }
        }   
        $user->save();
        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function show(ViewRequest $request, User $user)
    {   
        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function destroy(DeleteRequest $request, User $user)
    {   
        $user->delete();
        return $this->response->noContent()->setStatusCode(200);
    }
}
