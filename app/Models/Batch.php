<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batches';
    protected $fillables = ['beer_type', 'size', 'user_id'];
    
    public function beer()
    {
        return $this->hasOne(Beer::class);

    }
   
}
