<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKeySetting extends Model
{
    protected $table = 'api_key_settings';
    protected $guarded = [];
    public $timestamps = false;
}