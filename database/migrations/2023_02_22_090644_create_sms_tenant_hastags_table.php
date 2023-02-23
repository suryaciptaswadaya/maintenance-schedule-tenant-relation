<?php

use App\Models\smsHashtag;
use App\Models\smsTenant;
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
        Schema::create('sms_tenant_hashtags', function (Blueprint $table) {
            // $table->foreignIdFor(smsTenant::class,'sms_tenant_id')->constrained()->onDelete('cascade');
            // $table->foreignIdFor(smsHashtag::class,'sms_hashtag_id')->constrained()->onDelete('cascade');
            // $table->primary(['sms_tenant_id', 'sms_tenant_id']);
            $table->string('sms_tenant_id')->index();
            $table->string('sms_hashtag_id')->index();
            $table->foreign('sms_tenant_id')->references('id')->on('sms_tenants')->onDelete('cascade');
            $table->foreign('sms_hashtag_id')->references('id')->on('sms_hashtags')->onDelete('cascade');
            //$table->primary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_tenant_hashtags');
    }
};
