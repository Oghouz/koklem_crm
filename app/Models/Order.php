<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'num','status','payment_status','client_id','payment_method','shipping_method','total','total_lines','comment','created_by','updated_by'
    ];

    const ORDER_STATUS_PENDING = 1;
    const ORDER_STATUS_VALIDATED = 2;
    const ORDER_STATUS_DELIVERED = 3;
    const ORDER_STATUS_RETURNED = 8;
    const ORDER_STATUS_CANCELED = 9;

    /**
     * Relation : Une commande appartient à un client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Relation : Une commande possède plusieurs lignes de commande.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }

    // Si vous avez aussi besoin de l'utilisateur qui a créé ou mis à jour la commande :
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function getStatusLabel($status)
    {
        $labels = [
            self::ORDER_STATUS_PENDING => 'En attente',
            self::ORDER_STATUS_VALIDATED => 'Validée',
            self::ORDER_STATUS_DELIVERED => 'Livrée',
            self::ORDER_STATUS_RETURNED => 'Retournée',
            self::ORDER_STATUS_CANCELED => 'Annulée',
        ];

        return $labels[$status] ?? $labels;
    }

    public static function getStatusBadge($status)
    {
        $labels = [
            self::ORDER_STATUS_PENDING => '<span class="badge bg-secondary">En attente</span>',
            self::ORDER_STATUS_VALIDATED => '<span class="badge bg-success">Validée</span>',
            self::ORDER_STATUS_DELIVERED => '<span class="badge bg-primary">Livrée</span>',
            self::ORDER_STATUS_RETURNED => '<span class="badge bg-warning">Retournée</span>',
            self::ORDER_STATUS_CANCELED => '<span class="badge bg-danger">Annulée</span>',
        ];

        return $labels[$status] ?? 'Inconnu';
    }
}

