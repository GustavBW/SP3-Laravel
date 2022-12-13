<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';
    protected $fillable = ['max_speed', 'type', 'optimal_production_speed'];
    
}
