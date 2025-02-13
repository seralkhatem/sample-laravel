<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
   /* public function redirectTo() {
        $user = Auth::user();
        switch(true) {
            case $user->isInstructor():
                return '/instructor';
            case $user->isAdmin():
            case $user->isSuperAdmin():
                return '/admin';
            default:
                return '/account';
        }*/
public function username()
{
    return 'student_id';
}

 
protected function redirectTo()
{
        if(Auth::user()->is_admin == 1000001)
        {
            return '/ross';
        }
        else
        {
            if(Auth::user()->is_admin == 10){
                return '/pems/home';

            }else{
                 if(Auth::user()->is_admin > 0)
            {
                return '/map/home';

            }
            else
            {
                return '/pendinglogin';
            }
            }
           
        }

   }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


//-----------------------------------------------------NEW AUTH LOGIN-------------------------------------------------------------------
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  /*  protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }*/
}
