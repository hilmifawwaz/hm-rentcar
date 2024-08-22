<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($request);
        // return parent::toArray($request);
        return [
            'scheduleId' => $this->id_jadwal,
            'pelanggan' => $this->nama_pelanggan,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
            'harga' => $this->harga,
            'jaminan' => $this->jaminan,
            'status' => $this->status,
            'status_pembayaran' => $this->status_pembayaran,
            'mobil' => $this->mobil['merk'] . ' ' . $this->mobil['jenis'],
            'plat' => $this->mobil['plat_nomor']
        ];
    }
}
