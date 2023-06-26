<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_proveedor';
    protected $table = 'proveedores';
    public $timestamps = false;

    public $fillable = [
        'id_proveedor',
        'nombre',
        'ubicacion',
        'telefono',
        'estatus'
    ];

    public function producto(){
        return $this->hasMany(Producto::class, 'id_proveedor', 'id_proveedor');
    }
}
