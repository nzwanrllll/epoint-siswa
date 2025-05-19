<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggar extends Model
{
   //
    protected $fillable = [
        'id_siswa',
        'poin_pelanggar',
        'status_pelanggar',
        'status',
    ];
}
