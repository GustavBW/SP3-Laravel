<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueuedBatch extends Model
{
    use HasFactory;
    protected $table = 'queued_batches';
    protected $fillable = ['batch_id'];

    public function batch() {
        return $this->belongsTo(Batch::class);
    }
}
