<?php

namespace App\Models;

use App\Constants\Table;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // é a tabela associada ao model
    protected $table = Table::GAMES;
    
    // atributos da tabela games que são "preenchiveis"
    protected $fillable = [
        'name',
        'description',
        'rating',
        'release_date'
    ];
}