<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    public $fillable = [
        'id_usuario',
        'cp',
        'telefono',
        'rol',
        'membresia',
        'strikes',
        'id_user'
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function almacen(){
        return $this->hasOne(Almacen::class, 'id_administrador', 'id_usuario');
    }

    public function compra(){
        return $this->hasMany(Compra::class, 'id_usuario', 'id_usuario');
    }

    public function caja(){
        return $this->hasOne(Caja::class, 'id_caja', 'id_caja');
    }
}
