<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'states';
    protected $guarded = ['add_by','create_date'];
    public $timestamps = false;
}