<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = "almacenes";
    public $timestamps = false;
    public $primaryKey = "id_almacen";

    use HasFactory;

    public $fillable = [
        'id_almacen',
        'nombre',
        'ubicacion',
        'capacidad',
        'id_administrador',
        'activo'
    ];

    public function administrador(){
        return $this->belongsTo(User::class, 'id_administrador', 'id');
    }

    public function producto(){
        return $this->hasMany(Producto::class, 'id_almacen', 'id_almacen');
    }

    public function repartidor(){
        return $this->hasOne(Repartidor::class, 'id_repartidor', 'id_repartidor');
    }
}
