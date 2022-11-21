<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedBatches extends Model
{
    use HasFactory;
    protected $table = 'finished_batches';
    protected $fillables = ['brewed', 'failed', 'batch_id'];

    public function batch()
    {
        return $this->hasOne(Batch::class);
    }

}
