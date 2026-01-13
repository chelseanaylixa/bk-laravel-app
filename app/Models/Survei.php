<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    protected $table = 'survei';

    protected $fillable = [
        'nama',
        'email',
        'kepuasan',
        'masukan',
    ];
}
