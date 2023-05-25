<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getStatusAttribute()
    {
        return $this->enabled ? 'Ativo' : 'Inativo';
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
