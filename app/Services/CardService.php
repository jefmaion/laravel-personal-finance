<?php

namespace App\Services;

use App\Models\CreditCard;

class CardService extends Services {

    public function __construct()
    {
        parent::__construct(new CreditCard());
    }


    public function listToDatatable() {
        $data = [];
        $payments = $this->all();

        $link = '<a href="%s">%s</a>';

        foreach($payments as $item) {

            $status = '<i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>';

            if(!$item->enabled) {
                $status = '<i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>';
            } 

            $data[] = [
                'name' => sprintf($link, route('payment.show', $item), $item->name),
                'status' => $status . ' ' . $item->status
            ];
        }

        return json_encode(['data' => $data]);
    }


}