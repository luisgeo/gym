<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    public $table = "notificaciones";
    public $timestamps = false;
    public $primaryKey = "id_registro";

    public $fillable = [
        'id_registro',
        'id_usuario',
        'accion',
        'tipo_alerta',
        'fecha_registro'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
