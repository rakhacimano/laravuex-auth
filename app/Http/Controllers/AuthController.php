<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
 
use App\Models\User;
 
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'register');
    }
 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|confirmed'
        ]);
 
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
 
        $token = JWTAuth::fromUser($user);
 
        return response()->json(['success' => true, compact('user', 'token')], 200);
    }
 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
 
        if( $token = JWTAuth::attempt($credentials)) 
        {
            return response()->json(['success' => true, 'token' => $token], 200);
        }
        return response()->json(['success' => false], 401);
    }
 
    public function checkToken()
    {
        return response()->json(['success' => true], 200);
    }
 
    public function logout()
    {
        $logout = auth()->logout();
        return response()->json(['success' => true], 200);
    }
}
