<?php

    namespace App\Model\frontend;

    use Illuminate\Database\Eloquent\Model;

    class ActivationKey extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'user_activations';

        public function user()
        {
            return $this->belongsTo('App\Model\frontend\User', 'user_id');
        }

    }
    