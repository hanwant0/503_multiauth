<?php

    namespace App\Model\backend;

    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\Sluggable;

    class Auto extends Model
    {

        use Sluggable;

        public function sluggable()
        {
            return [
                'auto_slug' => [
                    'source' => 'auto_model'
                ]
            ];
        }

        protected $table = 'autos';
        protected $primaryKey = 'auto_id';

        public function automanufacturer()
        {
            return $this->belongsTo('App\Model\backend\Automanufacturer', 'automanufacturer_id');
        }

        public function tags()
        {
            return $this->belongsToMany('App\Model\backend\Tag', 'auto_tag')
                    ->withTimestamps();
        }

        public static function upload(UploadedFile $file, $uploadPath = null)
        {

            if (is_null($uploadPath))
            {
                $uploadPath = public_path() . '/uploads/auto/';
            }

            $fileName = str_slug(\getFileName($file->getClientOriginalName())) . '.' . $file->getClientOriginalExtension();

            while (file_exists($uploadPath . $fileName))
            {
                $fileName = str_slug(getFileName($file->getClientOriginalName())) . '-' . str_random(5) . '.' . $file->getClientOriginalExtension();
            }
            $file->move($uploadPath, $fileName);

            return ['filename' => $fileName, 'fullpath' => $uploadPath . $fileName];
        }

    }

?>