<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;
class SentResource extends JsonResource {
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request) {
    return [
      'no_surat' => $this->mail_number,
      'kepada' => $this->uid,
      'perihal' => $this->title,
      'tanggal' => Carbon::parse($this->created_at)->toDayDateTimeString(),
      'jenis_surat' => $this->type,
      'status' => $this->status,
      'keterangan' => $this->description
    ];
  }
}
