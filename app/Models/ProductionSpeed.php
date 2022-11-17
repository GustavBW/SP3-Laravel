<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionSpeed extends Model
{
    use HasFactory;
    protected $table = 'production_speeds';
    protected $fillables = ['bpm'];

}
