<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function model()
    {
        return User::class;
    }
    public function getUser()
    {
        $checkUser = $this->userCheck();
        $token = $checkUser->createToken('auth_token')->plainTextToken;
        if($token) {
            return $checkUser;
        } else {
            return null;
        }
    }

    public function userCheck() {
        if(auth()->check()) {
            $user = User::where('email', auth()->users()->email)->firstOrFail();
            if($user) {
                return $user;
            }
        }

        return response()->json('Unauthorized');


    }

}
