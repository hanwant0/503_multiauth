<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTagsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('tags', function (Blueprint $table)
            {
                $table->engine = 'InnoDB';
                $table->increments('tag_id');
                $table->string('tag_title', 100)->unique();
                $table->string('tag_slug', 200)->index();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('tags');
        }

    }
    