<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'tipo_pessoa',
        'cpf_cnpj',
        'email',
        'endereco',
        'cep',
        'cidade',
        'latitude',    // Adicione os campos de latitude e longitude aqui
        'longitude',   // Adicione os campos de latitude e longitude aqui
    ];

    // Certifique-se de que os campos 'latitude' e 'longitude' são do tipo float
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
