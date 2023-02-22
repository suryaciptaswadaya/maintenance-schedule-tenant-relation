<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scs_hashtags', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('scs_hashtag_category_id')->index();
            $table->string('name');
            $table->timestamps();
            $table->foreign('scs_hashtag_category_id')->references('id')->on('scs_hashtag_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scs_hashtags');
    }
};
