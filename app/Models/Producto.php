<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $table = 'productos';

    public $fillable = [
        'id_producto',
        'nombre',
        'modelo',
        'precio',
        'precio_unitario',
        'precio_medio_mayoreo',
        'precio_mayoreo',
        'precio_super_mayoreo',
        'descuento',
        'comision',
        'stock',
        'descripcion',
        'codigo',
        'id_proveedor',
        'id_almacen',
        'id_marca',
        'imagen',
        'estatus'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen', 'id_almacen');
    }

    public function repartos()
    {
        return $this->hasMany(Reparto::class, 'id_producto', 'id_producto')
            ->orderBy('id_almacen', 'asc');
    }

    public function sumRepartos()
    {
        return $this->join('reparto', 'reparto.id_producto', 'productos.id_producto')
            ->where('reparto.id_producto', '=', $this->id_producto)
            ->sum('reparto.stock');
    }
}
