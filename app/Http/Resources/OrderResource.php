<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'details'=>$this->details,
            'client'=>$this->client,
            'isFulfilled'=>$this->is_fulfilled,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
            'deletedAt'=>$this->deleted_at
        ];
    }
}
