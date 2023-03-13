<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMailAttendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sms_mail_id',
        'sms_tenant_id',
        'mail_title',
        'mail_content'
    ];
}
