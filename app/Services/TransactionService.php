<?php

namespace App\Services;


use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionService extends Services {

    public function __construct()
    {
        parent::__construct(new Transaction());
    }

    public function find($id) {
        if (!$data = Transaction::with(['category', 'payment', 'account'])->find($id)) {
            $this->_message = 'Registro não encontrado';
            return false;
        }

        return $data;
    }

    public function sumExpenses() {

        return Transaction::where('type', 'D')->where('is_paid', 1)->sum('value');
    }

    public function sumIncomes() {
        return Transaction::where('type', 'R')->where('is_paid', 1)->sum('value');
    }
    

    public function create($data) {

        

        if(!parent::create($data)) {
            return false;
        }

        if($data['repeat'] == 1) {

            for($i=1;$i<=$data['num_repeat'];$i++) {
                $data['date'] = date('Y-m-d', strtotime($data['date'] . '+'.$data['period'].' months'));
                $data['is_paid'] = 0;
                parent::create($data);
            }

        }

        return true;
    }

    public function listToDatatable() {
        $data = [];
        $transactions = Transaction::with(['category'])->orderBy('id', 'desc')->orderBy('date', 'desc')->get();

        $link = '<a href="%s">%s</a>';
        $label = '<span class="text-%s">%s</span>';

        foreach($transactions as $item) {

            $type = '<i class="fa fa-plus text-success" aria-hidden="true"></i> ';

            if($item->type == 'D') {
                $type = '<i class="fa fa-minus text-danger" aria-hidden="true"></i> ';
            } 

            $check = '
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="checkbox custom-control-input" value="'.$item->id.'" id="checkbox'.$item->id.'">
                <label class="custom-control-label" for="checkbox'.$item->id.'">'.$item->date->format('d/m/Y').'</label>
            </div>
            ';

            $data[] = [
                'date' => $check,
                'type' => $type .  $item->transactionType,
                'category' => $item->category->name,
                'description' => sprintf($link, route('transaction.show', $item), $item->description),
                'value' => sprintf($label, ($item->type == 'D' ? 'danger' : 'success'), 'R$ ' . currency($item->value)),
                'status' => $item->statusSpan
            ];
        }

        return json_encode(['data' => $data]);
    }


}