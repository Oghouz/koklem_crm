<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'reference',
        'category_id',
        'name',
        'size',
        'description',
        'price',
        'tva_id',
        'stock',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tva()
    {
        return $this->belongsTo(TVA::class, 'tva_id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'product_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
