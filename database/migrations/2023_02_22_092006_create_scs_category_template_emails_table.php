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
        Schema::create('scs_category_template_emails', function (Blueprint $table) {
            // $table->foreignId('scs_category_id')->constrained()->onDelete('cascade');
            // $table->foreignId('scs_template_email_id')->constrained()->onDelete('cascade');
            // $table->primary(['scs_category_id', 'scs_template_email_id']);

            $table->unsignedBigInteger('scs_category_id')->index();
            $table->unsignedBigInteger('scs_template_email_id')->index();
            $table->foreign('scs_category_id')->references('id')->on('scs_categories')->onDelete('cascade');
            $table->foreign('scs_template_email_id')->references('id')->on('scs_template_emails')->onDelete('cascade');

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
        Schema::dropIfExists('scs_category_template_emails');
    }
};
