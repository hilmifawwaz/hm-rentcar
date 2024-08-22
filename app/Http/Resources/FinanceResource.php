<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinanceResource extends JsonResource
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
            'financeId' => $this->id_keuangan ?? '-',
            'keterangan' => $this->keterangan,
            'masuk' => $this->masuk,
            'keluar' => $this->keluar,
            'tanggal' => $this->tanggal
        ];
    }
}
