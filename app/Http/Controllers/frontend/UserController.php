<?php

    namespace App\Http\Controllers\frontend;

    use App\Model\frontend\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Session;
    use App\Model\frontend\ActivationService;
    use App\Traits\ActivationKeyTrait;

    class UserController extends Controller
    {

        use ActivationKeyTrait;

        protected $activationService;

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct(ActivationService $activationService)
        {
            $this->activationService = $activationService;
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('home');
        }

        public function dashboard()
        {

            return view('frontend.dashboard');
        }

        public function userActivation($token)
        {

            // $this->validateToken($token);


            $user = $this->activationService->activateUser($token);

            if (!$user)
            {
                return redirect('user/login')->with('warning', 'your token is invalid');
            }
            else
            {
                $this->guard()->login($user);
                return redirect('user/dashboard');
            }
        }

        protected function guard()
        {
            return Auth::guard('user');
        }

    }
    