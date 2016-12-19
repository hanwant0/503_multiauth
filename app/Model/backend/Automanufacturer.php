<?php

    namespace App\Model\backend;

    use Illuminate\Database\Eloquent\Model;

    class Automanufacturer extends Model
    {

        //protected $fillable = array('title');
        protected $table = 'automanufacturers';
        protected $primaryKey = 'automanufacturer_id';

        public function autos()
        {
            return $this->hasMany('App\Model\backend\Auto');
        }

        // this is a recommended way to declare event handlers
        protected static function boot()
        {
            parent::boot();

            static::deleting(function($automanufacturer)
            { // before delete() method call this
                $automanufacturer->autos()->delete();
                // do the rest of the cleanup...
            });
        }

    }

?>