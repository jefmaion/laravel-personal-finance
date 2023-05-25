<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['date'];

    public function getTransactionTypeAttribute() {
        return ($this->type =='D') ? 'Despesa' : 'Receita';
    }


    public function getStatusAttribute() {
        return ($this->is_paid) ? 'Pago' : 'Aberto';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
