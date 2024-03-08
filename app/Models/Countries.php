<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $guarded = ['add_by','create_date'];
    public $timestamps = false;
}