<?php

namespace App\Models;

use App\Http\Livewire\HistorialPedidos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $table = "compras";
    public $timestamps = false;
    public $primaryKey = "id_compra";

    public $fillable = [
        'id_compra',
        'id_caja',
        'id_cliente',
        'fecha_compra',
        'estatus',
        'total',
        'tipo_compra',
        'cambio',
        'recibido',
        'acumulado_cliente'
    ];

    use HasFactory;

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'id_caja');
    }

    public function pedidos()
    {
        return $this->hasMany(HistorialPedidos::class, 'id_compra', 'id_compra');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function caja()
    {
        return $this->hasOne(Caja::class, 'id_caja', 'id_caja');
    }
}
