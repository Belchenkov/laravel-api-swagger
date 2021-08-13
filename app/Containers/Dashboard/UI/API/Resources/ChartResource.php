<?php

namespace App\Containers\Dashboard\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'date' => $this->date,
            'sum' => (float)($this->sum)
        ];
    }
}
