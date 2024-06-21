<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'payer' => new User($this->getPayer()),
            'payee' => new User($this->getPayee()),
            'amount' => $this->getAmount(),
            'status' => $this->getStatus(),
            'delivered_at' => $this->getDeliveredAt(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt(),
        ];
    }
}
