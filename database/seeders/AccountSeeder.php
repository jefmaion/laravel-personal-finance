<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Santander', 'NuBank', 'Carteira'];

        foreach($data as $item) {
            Account::create(['name' => $item, 'enabled' => 1]);
        }
    }
}
