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
            $table->char('maintenance_schedule_id',36);
            $table->char('maintenance_company_id',36);
            $table->text('email_sent');
            $table->timestamps();

            $table->foreign('maintenance_schedule_id')->references('id')->on('maintenance_schedules')->onDelete('cascade');
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
        Schema::dropIfExists('maintenance_schedule_attendees');
    }
};
