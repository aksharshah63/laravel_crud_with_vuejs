<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\Models\User; 
use Validator;
use Illuminate\Support\Str;


class AuthController extends Controller 
{
  
   private $apiToken;
   public function __construct()
   {
      //create token
      $this->apiToken = uniqid(base64_encode(Str::random(40)));
   }
  /** 
   * Register API 
   * 
   * @return \Illuminate\Http\Response 
   */ 
  public function user_register(Request $request) 
  { 

     $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
       
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken, 'status' => 'success']);
  }
}