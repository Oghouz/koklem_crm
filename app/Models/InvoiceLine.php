<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    use HasFactory;

    protected $table = 'invoice_lines';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'design_id',
        'product_reference',
        'product_name',
        'product_category',
        'product_description',
        'product_color',
        'product_size',
        'product_price',
        'product_tva',
        'quantity',
        'description'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
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
