<?php

namespace App\Http\Controllers\Api;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

use JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            JWTAuth::factory()->setTTL(600);
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->respondFailed('Email atau password anda salah');
            }

            $user = User::where('email', $credentials['email'])->first();

            if(request()->header('coordinate')) {
                $coordinate = explode(',', request()->header('coordinate'));
                $user->lat = $coordinate[0];
                $user->lng = $coordinate[1];
                $user->save();
            }

            if(request()->header('FCM')) {
                $user->fcm = request()->header('FCM');
                $user->save();
            }

            $user->role = $user->getRoleNames()[0];
            $user->token = $token;
            unset($user->roles);

            return $this->respondSuccess('Login Berhasil', $user);
        } catch (JWTException $e) {
            return $this->respondFailed();
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->respondFailed();
        }
        
        if(!Role::where('name', 'Customer')->first()) {
            Role::create(['name' => 'Customer']);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->assignRole('Customer');

        if(request()->header('coordinate')) {
            $coordinate = explode(',', request()->header('coordinate'));
            $user->lat = $coordinate[0];
            $user->lng = $coordinate[1];
            $user->save();
        }

        if(request()->header('FCM')) {
            $user->fcm = request()->header('FCM');
            $user->save();
        }

        JWTAuth::factory()->setTTL(600);
        $token = JWTAuth::fromUser($user);
        $user->role = $user->getRoleNames()[0];
        $user->token = $token;
        unset($user->roles);

        return $this->respondSuccess('Register Berhasil', $user);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
 
            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Maaf, user tidak dapat logout',
                'data' => [
                    'token' => 'Token tidak berlaku'
                ]
            ], 500);
        }
    }

    public function forgot(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return $this->respondFailed();
        } else {
            try {
                $response = \Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject('Password reset confirmation');
                });
                switch ($response) {
                    case \Password::RESET_LINK_SENT:
                        return $this->respondSuccess(trans($response));
                    case \Password::INVALID_USER:
                        return $this->respondFailed('User tidak ditemukan');
                }
            } catch (\Swift_TransportException $ex) {
                return $this->respondFailed($ex->getMessage());
            } catch (Exception $ex) {
                return $this->respondFailed($ex->getMessage());
            }
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}
