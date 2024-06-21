<?php

namespace App\Domain\Models;

use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SingleTableInheritanceTrait, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected static $singleTableTypeField = 'type';

    protected static $singleTableSubclasses = [
        UserCommon::class,
        UserShopKeeper::class,
    ];

    /**
     * @var array
     */
    protected static $persisted = [
        'name',
        'type',
        'document',
        'document_type',
        'email',
        'password',
        'balance'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'document',
        'document_type',
        'email',
        'password',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'document_type' => Document::class,
        'type' => Type::class,
        'balance' => 'float'
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
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of document
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @return  self
     */
    public function setDocument($document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get the value of document_type
     */
    public function getDocumentType(): Document
    {
        return $this->document_type;
    }

    /**
     * Set the value of document_type
     *
     * @return  self
     */
    public function setDocumentType($documentType): self
    {
        $this->document_type = $documentType;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of balance
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @return  self
     */
    public function setBalance($balance): self
    {
        $this->balance = $balance;

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

    /**
     * @return Collection|null
     */
    public function getPayment(): ?Collection
    {
        return $this->payment()->get();
    }

    /**
     * @return Collection|null
     */
    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;
        return $this;
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
