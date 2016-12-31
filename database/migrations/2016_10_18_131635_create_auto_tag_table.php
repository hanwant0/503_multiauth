<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAutoTagTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('auto_tag', function (Blueprint $table)
            {

                $table->increments('auto_tag_id');
                $table->integer('auto_id')->unsigned();
                $table->integer('tag_id')->unsigned();

                $table->foreign('auto_id')
                    ->references('auto_id')
                    ->on('autos')
                    ->onDelete('cascade');

                $table->foreign('tag_id')
                    ->references('tag_id')
                    ->on('tags')
                    ->onDelete('cascade');

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
            Schema::dropIfExists('auto_tag');
        }

    }
    