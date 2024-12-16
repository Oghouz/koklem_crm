<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'company',
        'type_company',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'city',
        'zip_code',
        'phone1',
        'phone2',
        'phone3',
        'siret',
        'tva_number',
        'iban',
        'bic',
        'comment',
        'created_by',
        'updated_by'
    ];
}
