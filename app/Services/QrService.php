<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class QrService
{
    /**
     * Genera un código QR en formato SVG y lo guarda en storage/app/public/qrs
     *
     * @param array $datos Datos a codificar (banco, cuenta, monto, referencia, etc.)
     * @param string|null $nombreArchivo Opcional, nombre del archivo sin extensión
     * @return string Ruta del archivo generado (relativa a storage)
     */
    public static function generar(array $datos, ?string $nombreArchivo = null): string
    {
        // Convertir array en texto
        $contenido = collect($datos)
            ->map(fn($v, $k) => strtoupper($k) . '=' . $v)
            ->implode("\n");

        // Nombre del archivo
        $nombreArchivo = $nombreArchivo ?? Str::random(10);
        $rutaArchivo = "qrs/{$nombreArchivo}.svg";

        // Genera QR como SVG
        $svg = QrCode::format('svg')
            ->size(300)       // tamaño del QR
            ->margin(2)       // margen
            ->generate($contenido);

        // Guardar en storage/public/qrs
        Storage::disk('public')->put($rutaArchivo, $svg);

        return $rutaArchivo; // ruta relativa para mostrar en web
    }
}
