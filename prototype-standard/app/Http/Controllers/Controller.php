<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallBack()
    {
        try{
            $user = Socialite::driver('google')->user();
        } catch(\Exception $e) {
            return redirect('/login');
        }


        //checking if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            Auth::login($existingUser, true);
        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
            ]);

            Auth::login($newUser, true);
        }
        return redirect()->to('/dashboard');
    }
}
