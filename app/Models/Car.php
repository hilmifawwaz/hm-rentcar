<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;
    public $table = "mobil";
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
