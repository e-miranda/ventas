<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VentaEstado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Venta extends Model
{
    
    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio',
        'nombre_comprador',
        'telefono',
        'email_deposito',
        'autorizacion',
        'imagen',
        'qr',
        'estado',
        'habilitado',
    ];
    protected $guarded = [];
    const PENDIENTE  = 0;
    const APROBADA   = 1;
    const RECHAZADA  = 2;
    const ENTREGADA  = 3; 

    public static function transicionesValidas(): array
    {
        return [
            self::PENDIENTE => [
                self::APROBADA,
                self::RECHAZADA,
            ],
            self::APROBADA => [
                self::ENTREGADA,
            ],
            self::RECHAZADA => [],
            self::ENTREGADA => [],
        ];
    }
    public function puedeCambiarA(int $nuevoEstado): bool
    {
        $transiciones = self::transicionesValidas();
        return in_array(
            $nuevoEstado,
            $transiciones[$this->estado] ?? [],
            true
        );
    }
    

    public function cambiarEstado(int $nuevoEstado): void
    {
        if (! $this->puedeCambiarA($nuevoEstado)) {
            throw ValidationException::withMessages([
                'estado' => 'Transición de estado no permitida',
            ]);
        }
        $estadoAnterior = $this->estado;
        $this->estado = $nuevoEstado;
        $this->save();
        $this->estados()->create([
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo'    => $nuevoEstado,
            'user_id'         => Auth::id(),
        ]);
    }


    // ===============================
    // Reglas de transición de estado
    // ===============================

    public function puedeAprobar(): bool
    {
        return $this->estado === self::PENDIENTE;
    }

    public function puedeRechazar(): bool
    {
        return $this->estado === self::PENDIENTE;
    }

    public function puedeEntregar(): bool
    {
        return $this->estado === self::APROBADA;
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function historial()
    {
        return $this->hasMany(VentaEstado::class);
    }

    public function estadoTexto(): string
    {
        return match ($this->estado) {
            self::PENDIENTE => 'Pendiente',
            self::APROBADA  => 'Aprobada',
            self::RECHAZADA => 'Rechazada',
            self::ENTREGADA => 'Entregada',
            default         => 'Desconocido',
        };
    }

}
