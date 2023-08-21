<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpSetting extends Model
{
    protected $fillable = [
        'name',
        'ip_address'
    ];
}
