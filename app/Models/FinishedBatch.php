<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedBatch extends Model
{
    use HasFactory;
    protected $table = 'finished_batches';
    protected $fillable = ['brewed', 'failed', 'batch_id'];

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

}
