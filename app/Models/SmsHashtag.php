<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsHashtag extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function hashTagCategory()
    {
        return $this->belongsTo(SmsHashtagCategory::class,'sms_hashtag_category_id','id');
    }

    public function tenants()
    {
        return $this->belongsToMany(SmsTenant::class,'sms_tenant_hashtags');
    }
}
