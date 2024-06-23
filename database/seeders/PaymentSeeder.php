<?php

namespace Database\Seeders;

use App\Domain\Models\Payment;
use App\Domain\Models\Wallet;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::factory()->create(1);
    }
}
