<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "keuangan";
    protected $primaryKey = "id_keuangan";
    protected $fillable = [
        'keterangan',
        'masuk',
        'keluar',
        'total',
        'tanggal'
    ];
}
