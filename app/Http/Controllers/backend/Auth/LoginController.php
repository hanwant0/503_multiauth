<?php

    namespace App\Http\Controllers\backend\Auth;

    use App\Model\backend\Admin;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
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
        protected $redirectTo = '/admin/dashboard';

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('guest', ['except' => 'logout']);
        }

        public function getLoginForm()
        {
            $data = array(
                'page_title' => 'Admin Login'
            );

            return view('backend/auth/login')->with($data);
        }

//        public function authenticate(Request $request)
//        {
//
//            $email = $request->input('email');
//            $password = $request->input('password');
//
//            if (auth()->guard('admin')->attempt(['email' => $email, 'password' => $password]))
//            {
//
//                return redirect()->intended('admin/dashboard');
//            }
//            else
//            {
//                return redirect()->intended('admin/login')->with('status', 'Invalid Login Credentials !');
//            }
//        }

        protected function guard()
        {
            return Auth::guard('admin');
        }

        public function getLogout()
        {
            auth()->guard('admin')->logout();
            return redirect()->intended('admin/login');
        }

    }
    