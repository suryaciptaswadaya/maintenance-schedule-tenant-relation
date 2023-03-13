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
        Schema::create('sms_mails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('sms_mail_template_categories_id')->index();
           // $table->unsignedBigInteger('sms_category_id')->index();
            //$table->unsignedBigInteger('sms_template_email_id ')->index();
            //$table->string('subject');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_online_meeting')->default(0);
            $table->boolean('is_required')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sms_mail_template_categories_id')->references('id')->on('sms_mail_template_categories')->onDelete('cascade');
            //$table->foreign('sms_template_email_id')->references('id')->on('sms_template_emails')->onDelete('cascade');
            //$table->foreign('sms_category_id')->references('id')->on('sms_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_mails');
    }
};
