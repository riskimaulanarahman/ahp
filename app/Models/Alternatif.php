<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'tb_alternatif';
    protected $primaryKey = 'kode_alternatif';
    public $incrementing = false;

    protected $fillable = [
        'kode_alternatif',
        'nik',
        'nama_alternatif',
        'tempat_lahir',
        'telepon',
        'alamat',
        'tgl_lahir',
        'tgl_daftar',
        'total',
        'unit_asal',
        'rank'
    ];
}
