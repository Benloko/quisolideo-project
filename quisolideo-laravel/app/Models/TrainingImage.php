<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingImage extends Model
{
    protected $fillable = [
        'training_id',
        'path',
        'sort_order',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
