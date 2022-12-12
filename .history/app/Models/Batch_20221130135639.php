<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batches';
    protected $fillable = ['beer_id', 'size', 'user_id','production_speed','status'];

    public function beer()
    {
        return $this->hasOne(Beer::class);

    }
}
