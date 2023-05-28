<?php

namespace App\Http\Controllers\Auth;

use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('hotel');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();

    }

    public function handleProvider()
    {
        try {
            $socialiteUser= Socialite::driver('google')->user();
            $user=User::where('email',$socialiteUser->getEmail())->first();
            if(!$user){
                $user=User::create([
                    'name' => $socialiteUser->getEmail(),
                    'email' => $socialiteUser->getEmail(),
                    'password' => Hash::make($socialiteUser->getId()),
                    'roll'=>Constants::CUSTOMER,
                ]);
            }

            auth()->login($user);
            return redirect()->route('hotel');
        }catch(\Exception $e){
            return redirect()->route('login');
        }

    }


}
