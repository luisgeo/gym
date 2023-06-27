<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cliente';
    protected $table = 'catclientes';
    public $timestamps = false;

    public $fillable = [
        'id_cliente',
        'nombre',
        'telefono',
        'correo',
        'acumulado',
        'estatus'
    ];

    public function antecedente(){
        return $this->hasOne(Antecedente::class, 'id_antecedente', 'id_antecedente');
    }
}
