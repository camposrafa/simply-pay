<?php

namespace Database\Factories;

use App\Domain\Enum\Payment\Status;
use App\Domain\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'payee_id' => 2,
            'payer_id' => 1,
            'amount' => 10,
            'status' => Status::success,
        ];
    }
}
