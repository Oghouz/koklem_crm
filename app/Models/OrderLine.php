<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'design_id', 'reference', 'name', 'size', 'color', 'quantity', 'price', 'comment', 'created_by', 'updated_by'
    ];

    /**
     * Relation : Une ligne de commande appartient à une commande.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Relation : Une ligne de commande concerne un produit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'design_id');
    }
}

