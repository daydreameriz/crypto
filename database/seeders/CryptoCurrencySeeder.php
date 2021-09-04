<?php

namespace Database\Seeders;

use App\Models\CryptoCurrency;
use Illuminate\Database\Seeder;

class CryptoCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CryptoCurrency::factory()->count(5)->create();
    }
}
