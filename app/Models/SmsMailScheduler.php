<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMailScheduler extends Model
{
    use HasFactory;

    protected $fillable = [
        'sms_mail_id',
        'send_date',
    ];
}
