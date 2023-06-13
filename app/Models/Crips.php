<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crips extends Model
{
    use HasFactory;

    protected $table = 'tb_crips';
    protected $primaryKey = 'kode_crips';
    public $incrementing = false;

    protected $fillable = ['kode_crips', 'nama_crips', 'kode_kriteria', 'bobot_crips'];
}
