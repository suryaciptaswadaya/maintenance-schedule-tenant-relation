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
        Schema::create('sms_mail_schedulers', function (Blueprint $table) {
            $table->id();
            $table->char('sms_mail_id',36)->index();
            $table->dateTime('send_date');
            $table->boolean('is_execute')->default(0);
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
        Schema::dropIfExists('sms_mail_schedulers');
    }
};
