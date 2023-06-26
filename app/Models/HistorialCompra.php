<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCompra extends Model
{
    use HasFactory;
    protected $table = "historial_compra";
    protected $primaryKey = "id_registro_compra";

    protected $fillable = [
        "id_registro_compra",
        "id_producto",
        "precio_aplicado",
        "cantidad",
        "descuento_aplicado",
        "id_compra",
        "id_almacen"
    ];

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id_producto', 'id_producto');
    }

    public function almacen()
    {
        return $this->hasOne(Almacen::class, 'id_almacen', 'id_almacen');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }
}
