<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
     * @var integer
     * @param role_id
     */
    protected function authenticated(Request $request, $user)
    {   
        $user_role = \DB::table('model_has_roles')->select('role_id')->where('model_id', $user->id)->first()->role_id;
          
        if ( $user_role == 3 ) {
            if($user->status == 1) {
                return redirect()->route('dashboard');
            }
            else{
                Auth::logout();
                flash('Berhasil menambahkan artikel')->success();
                return back();
            }
            // return redirect()->route('home');
        }   
        else{
            return redirect()->route('dashboard');
        }
    }
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
