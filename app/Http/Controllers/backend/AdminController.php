<?php

    namespace App\Http\Controllers\backend;

    use App\Model\backend\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Lang;

    class AdminController extends Controller
    {

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            
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
            $data['page_title'] = 'Dashboard';
            return view('backend.dashboard')->with($data);
        }

        public function setLanguage(Request $request)
        {
            $locale = $request->id;
            Session::put('locale', $locale);
            echo json_encode(TRUE);
        }

    }
    