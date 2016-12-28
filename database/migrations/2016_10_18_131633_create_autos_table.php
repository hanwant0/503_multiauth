<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Grammars\MySqlGrammar;
    use Illuminate\Support\Facades\DB;

    class CreateAutosTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('autos', function (Blueprint $table)
            {

                $table->increments('auto_id');
                $table->integer('automanufacturer_id')->unsigned();
                $table->string('auto_model', 100);
                $table->string('auto_slug', 150)->index();
                $table->decimal('auto_asking_price', 10, 0);
                $table->decimal('auto_mileage', 5, 2);
                $table->string('auto_image', 100);

                $table->foreign('automanufacturer_id')
                    ->references('automanufacturer_id')
                    ->on('automanufacturers')
                    ->onDelete('cascade');


                $table->timestamps();
            });

            DB::statement('ALTER TABLE autos ADD auto_model_year YEAR(4)');
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            
        }

    }
    