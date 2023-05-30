<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::select(['id', 'name'])->where('category_id', '<>', 0)->orWhereNull('category_id')->get();
        $types = ['R', 'D'];
        $accounts = Account::all();
        $payments = Payment::all();

        $startTime = date('Y-m-d', strtotime( '2022-05-01'));
        $endTime = date('Y-m-d', strtotime( '2023-05-31'));

       while($startTime <= $endTime) {
        Transaction::create([
            'description' => 'desc',
            'category_id' => $categories[rand(0, count($categories)-1)]->id,
            'account_id' => $accounts[rand(0, count($accounts)-1)]->id,
            'payment_id' => $payments[rand(0, count($payments)-1)]->id,
            'type' => $types[rand(0,1)],
            'date' => $startTime,
            'value' => rand(0, 13000) / 10,
            'is_paid' => 1
        ]);

        

        $startTime = date('Y-m-d', strtotime($startTime . ' +1 days'));


       }


        // for($i=0;$i<=5;$i++) {
        //     Transaction::create([
        //         'description' => $i,
        //         'category_id' => $categories[rand(0, count($categories)-1)]->id,
        //         'account_id' => $accounts[rand(0, count($accounts)-1)]->id,
        //         'payment_id' => $payments[rand(0, count($payments)-1)]->id,
        //         'type' => $types[rand(0,1)],
        //         'date' => '2023-05-31',
        //         'value' => rand(0, 13000) / 10
        //     ]);
        // }
    }
}
