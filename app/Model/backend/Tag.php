<?php

    namespace App\Model\backend;

    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\Sluggable;

    class Tag extends Model
    {

        use Sluggable;

        protected $table = 'tags';
        protected $primaryKey = 'tag_id';

        public function sluggable()
        {
            return [
                'tag_slug' => [
                    'source' => 'tag_title'
                ]
            ];
        }

        protected $fillable = ['tag_title'];

        public function autos()
        {
            return $this->belongsToMany('App\Model\backend\Auto', 'auto_tag')
                    ->withTimestamps();
        }

        public static function createAndReturnArrayOfTagIds($string, $delimiter = ',')
        {

            $tagsArray = explode($delimiter, $string);

            $ids = [];

            foreach ($tagsArray as $tag)
            {

                $tag = trim($tag);
                $theTag = \App\Model\backend\Tag::firstOrCreate(['tag_title' => $tag]);

                array_push($ids, $theTag->tag_id);
            }

            return $ids;
        }

    }
    