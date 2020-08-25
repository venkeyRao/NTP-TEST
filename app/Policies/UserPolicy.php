<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $authUser)
    {
        if($authUser->role == User::ROLE_NTP_ADMIN){
            return true;
        }
        return false;
    }

    public function update(User $authUser, User $user)
    {
        if($authUser->role == User::ROLE_NTP_ADMIN  && $user->role == User::ROLE_PRACTITIONER){
            return true;
        }
        return false;
    }

    public function delete(User $authUser, User $user)
    {
        if($authUser->role == User::ROLE_NTP_ADMIN && $user->role == User::ROLE_PRACTITIONER){
            return true;
        }
        return false;
    }
}
