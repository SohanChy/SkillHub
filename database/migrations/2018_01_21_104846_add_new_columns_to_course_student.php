<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToCourseStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_code')->nullable();
            $table->string('current_lesson')->nullable();
            $table->unsignedDecimal('rating')->nullable();
            $table->text('review')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('payment_code');
            $table->dropColumn('current_lesson');
            $table->dropColumn('rating');
            $table->dropColumn('review');
        });
    }
}
