<?php

    namespace App\Model\backend;

    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\Sluggable;

    class Automanufacturer extends Model
    {

        use Sluggable;

        //protected $fillable = array('title');
        protected $table = 'automanufacturers';
        protected $primaryKey = 'automanufacturer_id';
        protected $fillable = ['automanufacturer_title'];

        public function sluggable()
        {
            return [
                'automanufacturer_slug' => [
                    'source' => 'automanufacturer_title'
                ]
            ];
        }

        public function autos()
        {
            return $this->hasMany('App\Model\backend\Auto');
        }

    }

?>