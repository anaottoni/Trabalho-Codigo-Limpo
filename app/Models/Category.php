<?php

namespace App\Models;

use App\Constants\Table;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = Table::CATEGORIES;

    protected $fillable = [
        'name',
    ];
}