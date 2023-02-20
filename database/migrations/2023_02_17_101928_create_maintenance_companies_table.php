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
        Schema::create('maintenance_companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tenant_access_company_id');
            $table->string('name');
            $table->string('address'); //maintain master data?
            $table->string('origin'); // maintain master data?
            $table->string('feeder'); //penyulang // maintain master data?
            $table->string('operational_condition'); // maintain master data?
            $table->char('phase',5);
            $table->string('property'); // maintain master data?
            $table->json('hrga_information');
            $table->string('substasion'); // gardu induk // maintain master data?
            $table->char('trafo',5);
            $table->string('gas_provider'); // maintain master data?
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_companies');
    }
};
