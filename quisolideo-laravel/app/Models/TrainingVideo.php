<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingVideo extends Model
{
    protected $fillable = [
        'training_id',
        'path',
        'description',
        'sort_order',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
