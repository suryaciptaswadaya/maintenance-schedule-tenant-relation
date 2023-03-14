<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTenantHashtag extends Model
{
    use HasFactory;

    public $timestamps = false;
    //protected $primaryKey = null;
    protected $keyType = 'string';

}
