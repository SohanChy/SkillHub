<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->integer('poster_file_id')->unsigned()->nullable()->default(null);
            $table->tinyInteger('publish_status')->default(0);
            $table->tinyInteger('admin_status')->default(0);
            $table->decimal('rating',2,1)->default(0.0);
            $table->integer('price')->unsigned()->default(0);
            $table->integer('category_id')->unsigned();
            $table->text('small_description');
            $table->text('full_description');

            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('courses');
    }
}
