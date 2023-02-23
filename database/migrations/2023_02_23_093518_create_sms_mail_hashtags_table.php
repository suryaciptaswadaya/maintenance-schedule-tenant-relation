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
        Schema::create('sms_mail_hashtags', function (Blueprint $table) {
            $table->id();
            $table->char('sms_mail_id',36);
            $table->string('field');
            $table->text('value');
            $table->timestamps();

            $table->foreign('sms_mail_id')->references('id')->on('sms_mails')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_mail_hashtags');
    }
};
