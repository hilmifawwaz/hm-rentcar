<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'jadwal';
    public $primaryKey = 'id_jadwal';
    protected $fillable = [
        'nama_pelanggan',
        'id_mobil',
        'mulai',
        'selesai',
        'harga',
        'jaminan',
        'status',
        'status_pembayaran'
    ];

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'id_mobil', 'id_mobil');
    }
}
