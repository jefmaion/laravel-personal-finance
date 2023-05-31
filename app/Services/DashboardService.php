<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardService {

    public function getChartExpenseIncoming() {

        $data = DB::select(DB::raw("SELECT 
                                    MONTH(date) as month, 
                                    YEAR(date) as year, 
                                    sum(CASE WHEN type = 'D' THEN value ELSE null END) as expense, 
                                    sum(CASE WHEN type = 'R' THEN value ELSE null END) as incoming
                                    FROM 
                                        transactions 
                                    WHERE
                                        is_paid = 1
                                    GROUP BY 
                                        MONTH(date), 
                                        YEAR(date)
                                    ORDER BY
                                        YEAR(date) DESC,
                                        MONTH(date) DESC
                                    LIMIT 12 ")
                                );


        $months     = [];
        $expenses   = [];
        $incomings  = [];
        $monhtNames = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        foreach($data as $item) {
            $months[] = $monhtNames[($item->month-1)].'/'.($item->year - 2000);
            $expenses[] = $item->expense;
            $incomings[] = $item->incoming;
        }

        $months = array_reverse($months);
        $expenses = array_reverse($expenses);
        $incomings = array_reverse($incomings);



        $chartData = [
            'xAxis' => json_encode(['data' => $months]),
            'series' => json_encode([
                [
                    'name' => 'Receitas',
                    'type' => 'line',
                    'data' => $incomings,
                    'smooth' => true,
                    'itemStyle' =>  [
                        'color' => '#28a745'
                    ]
                ],
                [
                    'name' => 'Despesas',
                    'type' => 'line',
                    'data' => $expenses,
                    'smooth' => true,
                    'itemStyle' =>  [
                        'color' => '#bb414d'
                    ]
                ],
            ])
        ];

        return $chartData;

    }


    public function chartTransactionByCategory() {
        $data = DB::select(DB::raw("SELECT 
                            b.name,
                            sum(a.value) as value
                        FROM 
                            transactions a
                        INNER JOIN
                            categories b ON a.category_id = b.id
                        INNER JOIN
                            categories c ON c.id = b.category_id
                        WHERE
                            is_paid = 1 AND type = 'D'
                        GROUP BY 
                            b.name")
                    );

        $rs = [];
        foreach($data as $item) {
            $rs[] = [
                'value' => $item->value,
                'name' => $item->name
            ];
        }

        return json_encode($rs);
    }

}

// data: [
//     { value: 1048, name: 'Search Engine' },
//     { value: 735, name: 'Direct' },
//     { value: 580, name: 'Email' },
//     { value: 484, name: 'Union Ads' },
//     { value: 300, name: 'Video Ads' }
//   ]

// series: [
//     {
//       name: 'sales',
//       type: 'bar',
//       data: [5, 20, 36, 10, 10, 20]
//     },
//     {
//       name: 'sales',
//       type: 'bar',
//       data: [5, 20, 36, 10, 10, 20]
//     }
//   ]

// data: {
//     labels: ["January", "February", "March", "April", "May", "June", "July"],
//     datasets: [
//         {
//             label: "Data Set 1",
//             data: [65, 59, 80, 81, 56, 55, 40],
//         },
//         {
//             label: "Data Set 2",
//             data: [35, 40, 60, 47, 88, 27, 30],
//         }
//     ]
// }