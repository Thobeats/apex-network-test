<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Trait\HttpResponses;
use Exception;

class UserController extends Controller
{
    use HttpResponses;

    public function create(UserRequest $request)
    {
        try{
            $createUser = User::create($request->all());
            return $this->success($createUser, "User Created");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }

    public function all()
    {
        try{
            $users = User::all();
            return $this->success($users, "All Users");
        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }

    /**
     * @param integer The user's id
     */

    public function get($userId)
    {
        try{
            $user = User::find($userId);

            if (!$user)
            {
                return $this->error([], "User not found", 404);
            }

            return $this->success($user, "User Found");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }

    /**
     * @param integer The user's id
     */

    public function update(UserRequest $request, $userId)
    {
        try{
            $updateUser = User::where("id", $userId)->update($request->all());
            return $this->success($updateUser, "User Updated");
        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }

    /**
     * @param integer The user's id
     */

    public function delete($userId)
    {
        try{
            $user = User::find($userId);
            if (!$user)
            {
                return $this->error([], "User not found", 404);
            }
            $user->delete();
            return $this->success([], "User Removed");

        }catch(Exception $e){
            return $this->error([], $e->getMessage(),400);
        }
    }
}
