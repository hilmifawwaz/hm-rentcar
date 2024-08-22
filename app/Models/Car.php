<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "mobil";
    public $primaryKey = "id_mobil";
    protected $fillable = [
        'merk',
        'jenis',
        'plat_nomor',
        'tahun',
        'tranmisi',
        'harga_weekday',
        'harga_weekend',
    ];

    public function index()
    {
        $table = DB::table('mobil')->get();
        return $table;
    }
}
