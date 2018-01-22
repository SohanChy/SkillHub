<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseLiveStreamToPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function($table) {
            $table->integer('course_id')->nullable();
            $table->integer('live_stream_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function($table) {
            $table->dropColumn('course_id');
            $table->dropColumn('live_stream_id');
        });
    }
}
