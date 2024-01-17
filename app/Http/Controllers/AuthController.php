<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens;

    public function login(Request $request)
    {
        try {
            $credentials = [ 'username' => $request->input('username'), 'password' => $request->input('password') ];

            $user = User::where('username', $credentials['username'])->first();

            if (Auth::attempt($credentials)){
                auth()->loginUsingId( User::where( 'username',  $credentials['username'] )->first()->id );
                $user = auth()->user();
                $token = $user->createToken('grp_session')->plainTextToken;
                if ($token) {
                    return response()->json( [
                        'authenticated'             => true,
                        'grp_token'                 => $token,
                        'grp_token_expiration'      => date( 'D M d Y H:i:s', strtotime( "+8 hours" ) ),
                        'user'                      => static::getSessionInfo( $user->id ),
                    ], 200 );
                }
            }
            return response()->json( [
                'authenticated' => false,
            ], 200 );
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }

    public static function getSessionInfo($id)
    {
        $user = User::where('id', $id )->first();
        $permissions = $user->getPermissions();
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
