<?php

    namespace App\Model\frontend;

    use App\Notifications\UserResetPassword;
    use App\Notifications\UserActivationCode;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class User extends Authenticatable
    {

        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'email', 'password',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        public static function registeruser($input = array())
        {
            return User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => bcrypt($input['password']),
            ]);
        }

        public function routeNotificationForMail()
        {
            return $this->email;
        }

        public function sendPasswordResetNotification($token)
        {
            $this->notify(new UserResetPassword($token));
        }

        public function sendUserActivationCode($token)
        {
            $this->notify(new UserActivationCode($token));
        }

    }
    