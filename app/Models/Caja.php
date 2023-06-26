<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    public $table = "cajas";
    public $timestamps = false;
    public $primaryKey = 'id_caja';

    use HasFactory;

    public $fillable = [
        'id_caja',
        'abierta',
        'id_almacen',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function almacen()
    {
        return $this->hasOne(Almacen::class, 'id_almacen', 'id_almacen');
    }
}
