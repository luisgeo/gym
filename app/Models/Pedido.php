<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $primaryKey = 'id_pedido';
    public $timestamps = false;
    protected $table = 'pedidos';

    public $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'id_compra'
    ];

    public function producto(){
        return $this->hasOne(Producto::class, 'id_producto', 'id_producto');
    }

    public function compra(){
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }
}
