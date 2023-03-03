<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMailCategory extends Model
{
    use HasFactory;

    public function templates()
    {
        return $this->belongsToMany(SmsMailTemplate::class,'sms_mail_template_categories');
    }
}
