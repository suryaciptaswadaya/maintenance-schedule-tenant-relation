<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsHashtagCategory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function scopeWithoutHrgaInformation($query)
    {
        return $query->whereNotIn('name',['hrga_information','representative']);
    }
}
