<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

class LoginController extends Controller
{
  private $apiToken;
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
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    public function user_login(Request $request)
    {
        $loginData = $request->validate([
          'email' => 'email|required',
          'password' => 'required'
      ]);

      if (!auth()->attempt($loginData)) {
          return response(['status' => 'error']);
      }
      else
      {
          $accessToken = auth()->user()->createToken('authToken')->accessToken;

          return response(['user' => auth()->user(), 'access_token' => $accessToken, 'status' => 'success' ,'user' => auth()->user()->name]);
      }

      
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return response()->json([
          'status'   => 'success',
        ]); 
    }

}
