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
        Schema::create('maintenance_schedule_attendees', function (Blueprint $table) {
            $table->id();
            $table->string('maintenance_schedule_id');
            $table->string('tenant_access_company_id');
            $table->string('email');
            $table->string('is_required')->default('required');
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
        Schema::dropIfExists('maintenance_schedule_attendees');
    }
};
