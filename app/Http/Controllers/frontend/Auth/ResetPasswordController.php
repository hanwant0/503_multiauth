<?php

    namespace App\Http\Controllers\frontend\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\ResetsPasswords;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Http\Request;

    class ResetPasswordController extends Controller
    {
        /*
          |--------------------------------------------------------------------------
          | Password Reset Controller
          |--------------------------------------------------------------------------
          |
          | This controller is responsible for handling password reset requests
          | and uses a simple trait to include this behavior. You're free to
          | explore this trait and override any methods you wish to tweak.
          |
         */

use ResetsPasswords;

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public $redirectTo = '/user/dashboard';

        public function __construct()
        {
            $this->middleware('guest');
        }

        public function showResetForm(Request $request, $token = null)
        {
            return view('frontend.auth.passwords.reset')->with(
                    ['token' => $token, 'email' => $request->email]
            );
        }

        /**
         * Get the broker to be used during password reset.
         *
         * @return \Illuminate\Contracts\Auth\PasswordBroker
         */
        public function broker()
        {
            return Password::broker('users');
        }

        /**
         * Get the guard to be used during password reset.
         *
         * @return \Illuminate\Contracts\Auth\StatefulGuard
         */
        protected function guard()
        {
            return Auth::guard('user');
        }

    }
    