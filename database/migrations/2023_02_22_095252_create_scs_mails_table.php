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
        Schema::create('scs_mails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('scs_category_id')->index();
            $table->string('subject');
            $table->boolean('is_online_meeting')->default(0);
            $table->boolean('is_required')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('scs_category_id')->references('id')->on('scs_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scs_mails');
    }
};
