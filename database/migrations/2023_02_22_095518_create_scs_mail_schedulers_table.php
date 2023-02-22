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
        Schema::create('scs_mail_schedulers', function (Blueprint $table) {
            $table->id();
            $table->char('scs_mail_id',36)->index();
            $table->dateTime('date_time');
            $table->boolean('is_sent');
            $table->timestamps();

            $table->foreign('scs_mail_id')->references('id')->on('scs_mails')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scs_mail_schedulers');
    }
};
