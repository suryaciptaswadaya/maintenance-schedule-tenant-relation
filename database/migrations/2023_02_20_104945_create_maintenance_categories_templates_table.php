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
        Schema::create('maintenance_categories_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('template_email_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('maintenance_categories')->onDelete('cascade');
            $table->foreign('template_email_id')->references('id')->on('maintenance_template_emails')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('maintenance_categories_templates', function (Blueprint $table) {
            $table->dropForeign(['category_id,template_email_id']);
        });
        Schema::dropIfExists('maintenance_categories_templates');
    }
};
