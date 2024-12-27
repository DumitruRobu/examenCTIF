<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IbanCodesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'codul_eco'=>$this->codul_eco,
            'raion'=>$this->raion,
            'localitatea'=>$this->localitatea,
            'codul_iban'=>$this->iban_code,
        ];
    }
}
