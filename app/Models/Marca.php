<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_marca';
    protected $table = 'marcas';
    public $timestamps = false;

    public $fillable = [
        'id_marca',
        'nombre',
        'estatus'
    ];

    public function producto(){
        return $this->hasMany(Producto::class, 'id_marca', 'id_marca');
    }

}
