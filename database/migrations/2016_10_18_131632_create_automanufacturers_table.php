<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAutomanufacturersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('automanufacturers', function (Blueprint $table)
            {
                $table->engine = 'InnoDB';
                $table->increments('automanufacturer_id');
                $table->string('automanufacturer_title', 50)->unique();
                $table->string('automanufacturer_slug', 100)->index();
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
            Schema::dropIfExists('automanufacturers');
        }

    }
    