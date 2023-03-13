<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'start_date',
        'end_date',
        'sms_mail_template_categories_id',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function category()
    {
        return $this->hasOneThrough(SmsMailCategory::class,SmsMailTemplateCategory::class,'id','id','sms_mail_template_categories_id','sms_mail_category_id');
    }

    public function template()
    {
        return $this->hasOneThrough(SmsMailTemplate::class,SmsMailTemplateCategory::class,'id','id','sms_mail_template_categories_id','sms_mail_template_id');
    }

    public function affected_tenants()
    {
        return $this->hasMany(SmsMailAttendee::class,'sms_mail_id','id');
    }

    public function schedule_reminders()
    {
        return $this->hasMany(SmsMailScheduler::class,'sms_mail_id','id');
    }
}

