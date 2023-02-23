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
        Schema::create('sms_mail_template_hashtags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sms_mail_template_id')->index();
            $table->string('title');
            $table->string('field');
            $table->string('sms_hashtag_category_id')->index()->nullable();
            $table->string('value_type',50)->nullable();
            $table->timestamps();

            $table->foreign('sms_mail_template_id')->references('id')->on('sms_mail_templates')->onDelete('cascade');
            $table->foreign('sms_hashtag_category_id')->references('id')->on('sms_hashtag_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_mail_template_hashtags');
    }
};
