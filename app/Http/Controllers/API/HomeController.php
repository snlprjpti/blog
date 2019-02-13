<?php

namespace App\Http\Controllers\API;

use App\Notifications\SignupActivate;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        try{
            $user = new User();
//        $user = $request->all();
//        $user = User::firstOrNew(['email' => $request->email]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->activation_token = str_random(60);
            $user->password = bcrypt($request->password);
            $user->save();
            $user->notify(new SignupActivate($user));
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);

//            return $response;
//         echo the access token; normally we would save this in the DB
//            return response(['data' => json_encode((string) $response->getBody(),true)]);
//        return json_decode((string)$response->getBody(), true)['access_token'];
        }
        catch (\Exception $e){
            return $e;
        }

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personals Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();


        $cookie = setcookie('token',$tokenResult->accessToken);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function registerActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }


}
