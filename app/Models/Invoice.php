<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const DUE_DATE = 30; // Date d'échéance

    protected $table = 'invoices';

    protected $fillable = [
        'invoice_num',
        'order_id',
        'client_id',
        'client_company',
        'client_first_name',
        'client_last_name',
        'client_address1',
        'client_address2',
        'client_zip_code',
        'client_city',
        'client_siret',
        'client_tva_number',
        'client_email',
        'client_phone',
        'issue_date',
        'due_date',
        'status',
        'payment_method',
        'total_ht',
        'total_tva',
        'total_ttc',
        'total_paid',
        'accounted',
        'created_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function lines()
    {
        return $this->hasMany(InvoiceLine::class, 'invoice_id');
    }
}
