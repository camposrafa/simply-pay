<?php

namespace App\Domain\Models;

use App\Domain\Enum\Payment\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'payer_id',
        'payee_id',
        'amount',
        'delivered_at',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of delivered_at
     */
    public function getDeliveredAt(): ?Carbon
    {
        return $this->delivered_at;
    }

    /**
     * Set the value of deliveredAt
     *
     * @return  self
     */
    public function setDeliveredAt($deliveredAt): self
    {
        $this->delivered_at = $deliveredAt;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of payee
     */
    public function getPayeeId(): int
    {
        return $this->payee_id;
    }

    /**
     * Set the value of payeeId
     *
     * @return  self
     */
    public function setPayeeId($payeeId): self
    {
        $this->payee_id = $payeeId;

        return $this;
    }

    /**
     * Get the value of payee
     */
    public function getPayee(): User
    {
        return $this->payee;
    }

    /**
     * Set the value of payee
     *
     * @return  self
     */
    public function setPayee($payee): self
    {
        $this->payee = $payee;

        return $this;
    }

    /**
     * Get the value of payerId
     */
    public function getPayerId(): int
    {
        return $this->payer_id;
    }

    /**
     * Set the value of payerId
     *
     * @return  self
     */
    public function setPayerId($payerId): self
    {
        $this->payer_id = $payerId;

        return $this;
    }

    /**
     * Get the value of payer
     */
    public function getPayer(): User
    {
        return $this->payer;
    }

    /**
     * Set the value of payer
     *
     * @return  self
     */
    public function setPayer($payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get the value of uuid
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     *
     * @return  self
     */
    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->deleted_at;
    }

    public function payee()
    {
        $this->hasOne(User::class);
    }

    public function payer()
    {
        $this->hasOne(User::class);
    }
}
