<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    use HasFactory;

    protected $table = 'tb_konfigurasi';
    // protected $primaryKey = 'kode_kriteria';
    // public $incrementing = false;
    protected $guarded = ['id'];

    // protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot'];
}
