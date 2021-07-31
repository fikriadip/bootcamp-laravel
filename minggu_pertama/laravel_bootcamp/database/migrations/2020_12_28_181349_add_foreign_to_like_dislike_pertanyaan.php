<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToLikeDislikePertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
Schema::table('like_dislike_pertanyaan', function (Blueprint $table) {
    $table->unsignedBigInteger('pertanyaan_id');
    $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan');
    $table->unsignedBigInteger('profil_id');
    $table->foreign('profil_id')->references('id')->on('profil');
    $table->primary(['pertanyaan_id', 'profil_id']);
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('like_dislike_pertanyaan', function (Blueprint $table) {
            //
        });
    }
}
