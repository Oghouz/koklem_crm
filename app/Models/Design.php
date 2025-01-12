<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $table = 'designs';

    protected $fillable = [
        'reference',
        'name',
        'image',
        'description',
        'created_by',
        'updated_by',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
