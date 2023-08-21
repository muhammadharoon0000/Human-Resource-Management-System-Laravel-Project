<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable =[

        "site_title", "site_logo","time_zone","currency", "currency_position", "staff_access", "date_format", "theme","footer","footer_link","rtl_layout",
    ];
}
