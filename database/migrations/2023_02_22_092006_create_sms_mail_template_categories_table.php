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
        Schema::create('sms_mail_template_categories', function (Blueprint $table) {
            // $table->foreignId('sms_category_id')->constrained()->onDelete('cascade');
            // $table->foreignId('sms_mail_template_id')->constrained()->onDelete('cascade');
            // $table->primary(['sms_category_id', 'sms_mail_template_id']);

            $table->id();
            $table->unsignedBigInteger('sms_category_id')->index();
            $table->unsignedBigInteger('sms_mail_template_id')->index();
            $table->foreign('sms_category_id')->references('id')->on('sms_categories')->onDelete('cascade');
            $table->foreign('sms_mail_template_id')->references('id')->on('sms_mail_templates')->onDelete('cascade');

            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('template_email_id');
            // $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('maintenance_categories')->onDelete('cascade');
            // $table->foreign('template_email_id')->references('id')->on('maintenance_template_emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_mail_template_categories');
    }
};
