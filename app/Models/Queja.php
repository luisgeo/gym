<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queja extends Model
{
    use HasFactory;
    public $table= 'quejas';
    public $primaryKey = 'id_queja';
    public $timestamps = false;

    public $fillable = [
        'id_queja',
        'id_compra',
        'mensaje',
        'estatus',
        'id_usuario'
    ];

    public function compra(){
        return $this->hasOne(Compra::class, 'id_compra', 'id_compra');
    }

    public function usuario(){
        return $this->hasOne(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
