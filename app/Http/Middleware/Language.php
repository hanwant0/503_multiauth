<?php

    namespace App\Http\Middleware;

    use Illuminate\Http\Request;
    use Illuminate\Foundation\Application;
    use Illuminate\Routing\Redirector;
    use Closure;

    class Language
    {

        public function __construct(Application $app, Redirector $redirector, Request $request)
        {
            $this->app = $app;
            $this->redirector = $redirector;
            $this->request = $request;
        }

        public function handle($request, Closure $next)
        {
            if (!\Session::has('locale'))
            {
                \Session::put('locale', \Config::get('app.locale'));
            }
            $this->app->setLocale(\Session::get('locale'));
            return $next($request);
        }

    }
    