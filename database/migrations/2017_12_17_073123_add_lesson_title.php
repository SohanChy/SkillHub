<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLessonTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('title')->default(null);            
        });
    }

    
    public function down()
    {
       Schema::table('lessons', function (Blueprint $table) {
        $table->dropColumn('title');            
    });
   }
}
