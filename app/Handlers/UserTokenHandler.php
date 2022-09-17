<?php


namespace App\Handlers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTokenHandler
{
    public function createUser($name, $email, $password): User {
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = Hash::make($password);
        $newUser->save();
        $newUser->token = $newUser->createToken($newUser->name. $newUser->email)->accessToken;
        return $newUser;
    }


    public function regenerateUserToken(User $user){
//        $user->tokens()->delete();
        $user->token = $user->createToken($user->name. $user->email)->accessToken;
        return $user;
    }

    public function revokeTokens(User $user){
        $user->tokens()->delete();
    }
}
