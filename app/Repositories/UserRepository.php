<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private function getUserType(User $user)
    {
        if($user->hasAnyRole(['admin', 'super_admin'])){
            $user->admin;
        } elseif ($user->hasAnyRole(['manager_admin', 'manager_account', 'manager_store', 'worker'])){
            $user->user;
        } else{
            return null;
        }
        return $user;
    }

    public function login(array $request)
    {
        $user = User::where('email', $request['email'])->firstOrFail();
        if($user && Hash::check($request['password'], $user->password)){
            $userTokenHandler = new UserTokenHandler();
            $user = $this->getUserType($userTokenHandler->regenerateUserToken($user));
            return $user;
        }

        return null;
    }

    public function changePassword(array $request)
    {
        $user = User::where('phone', $request['phone'])->firstOrFail();
        if(!$user || !Hash::check($request['old_password'], $user->password)){
            return null;
        }

        $user->password = Hash::make($request['password']);
        $user->save();

        $userTokenHandler = new UserTokenHandler();
        $userTokenHandler->revokeTokens($user);

        return $user;
    }


    public function fetchUserById($user_id)
    {
        // TODO: Implement fetchUserById() method.
        $user = User::where('id', $user_id)->with('roles')->firstOrFail();
        return $user;
    }

    public function storeUser(array $request){
        $newUser = new User();

        $newUser->name = $request['name'];
        $newUser->email = $request['email'];
        $newUser->password = Hash::make($request['password']);

        $newUser->save();
        $newUser->assignRole('user');

        return $newUser;
    }

    public function updateUser(array $request)
    {
        // TODO: Implement updateUser() method.
        $user = User::findOrFail($request['id']);
        if(Hash::check($request['password'], $user->password)){
            $user->name=$request['name'];
            $user->email=$request['email'];
            $user->save();
        }
        else {
            return "Password did not matched";
        }
        return $user;
    }
}
