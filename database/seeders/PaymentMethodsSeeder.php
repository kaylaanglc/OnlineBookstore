<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;


class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = ['Gopay', 'OVO', 'ShopeePay', 'BCA Virtual Account', 'Mandiri Virtual Account'];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create(['name' => $method]);
        }
    }
}
