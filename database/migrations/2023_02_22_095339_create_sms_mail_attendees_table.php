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
        Schema::create('sms_mail_attendees', function (Blueprint $table) {
            $table->id();
            $table->char('sms_mail_id',36)->index();
            $table->string('sms_tenant_id')->index();
            //$table->unsignedBigInteger('sms_mail_scheduler_id')->index();
            $table->title('mail_subject');
            $table->text('mail_content');
            $table->boolean('is_send')->default(0);
            $table->timestamps();

            $table->foreign('sms_mail_id')->references('id')->on('sms_mails')->onDelete('cascade');
            $table->foreign('sms_tenant_id')->references('id')->on('sms_tenants')->onDelete('cascade');
            //$table->foreign('sms_mail_scheduler_id')->references('id')->on('sms_mail_schedulers')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_mail_attendees');
    }
};
