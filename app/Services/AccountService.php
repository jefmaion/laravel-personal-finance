<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Category;

class AccountService extends Services {

    public function __construct()
    {
        parent::__construct(new Account());
    }


    public function listToDatatable() {
        $data = [];
        $accounts = $this->all();

        $link = '<a href="%s">%s</a>';

        foreach($accounts as $item) {

            $status = '<i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>';

            if(!$item->enabled) {
                $status = '<i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>';
            } 

            $data[] = [
                'name' => sprintf($link, route('account.show', $item), $item->name),
                'status' => $status . ' ' . $item->status
            ];
        }

        return json_encode(['data' => $data]);
    }


}