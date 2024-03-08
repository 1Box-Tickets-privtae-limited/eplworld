<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'general_settings';
    protected $guarded = [];
    public $timestamps = false;
}


class SiteSetting extends Setting
{
    protected $table = 'site_settings';
    protected $guarded = [];
    public $timestamps = false;
}