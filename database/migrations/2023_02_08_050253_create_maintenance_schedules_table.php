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
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('subject');
            $table->text('content');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->string('location');
            $table->boolean('is_online_meeting')->default(0);
            $table->boolean('is_execute_reminder_7days_before')->default(0);
            $table->boolean('is_execute_reminder_tommorow')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_schedules');
    }
};
