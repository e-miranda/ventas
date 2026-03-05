<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
      protected $fillable = [
        'nombre',
        'cantidad',
        'precio',
        'imagen',
        'costo_unitario',
        'estado'
    ];
}
