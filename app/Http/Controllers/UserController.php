<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
            if ($user && \Hash::check($request->password,$user->password))
            {
                //if( $user->status_user_id != 2 )
                if(true)
                {
                    return 
                    [
                        'error' => 0,
                        'api_token' => $user->api_token,
                        'user_id' => $user->id
                    ];
                }else{
                    return 
                    [
                        'error' => 1,
                        'message' => 'El usuario se encuentra inactivo.'
                    ];
                }
            }else{
                return 
                [
                    'error' => 2,
                    'message' => 'El usuario no se encuentra en nuestros registros.'
                ];
            }
    }

    public function UpdateFcmToken(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return $user;
    }

    public function DeleteFcmToken(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $user->fcm_token = NULL;
        $user->save();
        return $user;
    }
}
