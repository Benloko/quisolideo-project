<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingRegistration extends Model
{
    protected $fillable = [
        'training_id',
        'first_name',
        'last_name',
        'email',
        'education_level',
        'photo_path',
        'cv_path',
        'phone',
        'message',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
