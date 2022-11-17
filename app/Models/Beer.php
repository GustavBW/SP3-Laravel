<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

        public function productionspeed()
        {
            return $this->hasOne(ProductionSpeed::class);
        }

}
