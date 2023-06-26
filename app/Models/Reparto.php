<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    use HasFactory;

    public $primaryKey = 'id_reparto';
    public $timestamps = false;
    protected $table = 'reparto';

    public $fillable = [
        'id_reparto',
        'id_producto',
        'id_almacen',
        'stock'
    ];

    public function producto(){
        return $this->hasOne(Producto::class, 'id_producto', 'id_producto');
    }

    public function almacen(){
        return $this->hasOne(Almacen::class, 'id_almacen', 'id_almacen');
    }

}
