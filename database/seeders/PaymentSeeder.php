<?php

namespace Database\Seeders;

use App\Models\Payment;
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
        $data = ['Pix', 'Débito', 'Crédito', 'Transferência', 'Dinheiro'];


        foreach($data as $item) {
            Payment::create(['name' => $item, 'enabled' => 1]);
        }
    }
}
