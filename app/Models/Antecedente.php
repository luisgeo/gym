<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $primaryKey= 'id_antecedente';

    public $table = 'antecedente_medico';

    public $fillable = [

        'id_antecedente',
        'alergico',
        'alergico_expl',
        'lesion',
        'lesion_expl',
        'cardiovascular',
        'cardiovascular_expl',
        'desmayo',
        'desmayo_expl',
        'anemia',
        'anemia_expl',
        'pie_plano',
        'pie_plano_expl'

    ];
}
