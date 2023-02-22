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
        Schema::create('scs_mail_attendees', function (Blueprint $table) {
            $table->id();
            $table->char('scs_mail_id',36)->index();
            $table->string('scs_tenant_id')->index();
            $table->text('template_mail_sent');
            $table->timestamps();

            $table->foreign('scs_mail_id')->references('id')->on('scs_mails')->onDelete('cascade');
            $table->foreign('scs_tenant_id')->references('id')->on('scs_tenants')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scs_mail_attendees');
    }
};
