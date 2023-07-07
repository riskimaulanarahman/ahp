<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $table = 'tb_tindakan';
    protected $guarded = ['id'];

    protected $casts = [
        'shift' => 'integer',
        'status_tindakan' => 'integer',
    ];
}
