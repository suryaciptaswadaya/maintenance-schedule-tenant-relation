<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMailTemplateHashtag extends Model
{
    use HasFactory;

    const VALUE_TYPE_HTML_CLASS = [
        'time' => 'single-time-picker',
        'date' => 'single-date-picker'
    ];
}
