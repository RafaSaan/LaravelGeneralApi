<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function getSessionInfo(Request $request)
    {
        $user = User::where('id', 5 )->first();
        $permissions = $user->getPermissions();
        $auth_role = UserProfile::where('id',$user->profile_id)->with('permissions')->first();

        return (object)[
            'id'                 => $user->id,
            'email'              => $user->email,
            'username'           => $user->username,
            'name'               => $user->name,
            'first_name'         => $user->first_name,
            'last_name'          => $user->last_name,
            'permissions'        => $permissions,
            'profile_id'         => $user->profile_id,
            'profile'            => $user->getprofile->name,
        ];
    }
}
