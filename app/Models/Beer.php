<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';
    protected $fillable = ['name', 'production_speed'];

    public function productionspeed()
    {
            return $this->hasOne(ProductionSpeed::class);
    }

    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }


}
