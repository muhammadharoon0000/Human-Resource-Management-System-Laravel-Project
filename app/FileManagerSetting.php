<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileManagerSetting extends Model
{
	protected $fillable=['allowed_extensions','max_file_size'];
}
