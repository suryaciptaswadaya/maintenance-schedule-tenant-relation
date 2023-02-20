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
        Schema::create('maintenance_company_water_meters', function (Blueprint $table) {
            $table->id();
            $table->char('maintenance_company_id',36);
            $table->string('name');
            $table->timestamps();

            $table->foreign('maintenance_company_id')->references('id')->on('maintenance_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['maintenance_company_id']);
        Schema::dropIfExists('maintenance_company_water_meters');
    }
};
