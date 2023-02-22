<?php

use App\Models\ScsHashtag;
use App\Models\ScsTenant;
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
        Schema::create('scs_tenant_hashtags', function (Blueprint $table) {
            // $table->foreignIdFor(ScsTenant::class,'scs_tenant_id')->constrained()->onDelete('cascade');
            // $table->foreignIdFor(ScsHashtag::class,'scs_hashtag_id')->constrained()->onDelete('cascade');
            // $table->primary(['scs_tenant_id', 'scs_tenant_id']);
            $table->string('scs_tenant_id')->index();
            $table->string('scs_hashtag_id')->index();
            $table->foreign('scs_tenant_id')->references('id')->on('scs_tenants')->onDelete('cascade');
            $table->foreign('scs_hashtag_id')->references('id')->on('scs_hashtags')->onDelete('cascade');
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
        Schema::dropIfExists('scs_tenant_hashtags');
    }
};
