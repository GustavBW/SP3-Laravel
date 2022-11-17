<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';
    protected $fillables = ['name', 'production_speed'];
    public function production_speed()
    {
            return $this->hasOne(ProductionSpeed::class);
    }

   
}
