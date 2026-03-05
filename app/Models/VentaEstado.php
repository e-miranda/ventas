<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaEstado extends Model
{
    protected $fillable = [
        'venta_id',
        'estado_anterior',
        'estado_nuevo',
        'user_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
