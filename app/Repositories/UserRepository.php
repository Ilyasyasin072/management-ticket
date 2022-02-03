<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

use Illuminate\Support\Facades\Auth;
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
        if($checkUser) {
            return $checkUser;
        } else {
            return null;
        }
    }

    public function userCheck() {
        if(auth()->check()) {
            $user = User::where('email', auth()->user()->email)->firstOrFail();
            if($user) {
                return $user;
            }
        }

        return response()->json('Unauthorized');


    }

}
