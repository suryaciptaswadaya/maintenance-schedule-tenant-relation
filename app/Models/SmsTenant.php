<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTenant extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function informations()
    {
        return $this->belongsToMany(SmsHashtag::class,'sms_tenant_hashtags');//->wherePivotIn('sms_tenant_hashtags.sms_hashtag_id',['MHG-0235','MHG-0230']);
    }
}
