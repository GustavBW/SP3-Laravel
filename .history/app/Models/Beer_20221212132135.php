<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';
    protected $fillable = ['production_speed_id', 'recipe_id', 'type', 'optimal_production_speed'];

    public function productionspeed()
    {
            return $this->hasMany(ProductionSpeed::class);
    }

    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }


}
