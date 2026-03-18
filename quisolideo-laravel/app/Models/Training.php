<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['title','slug','short_description','content','image','seats','price'];

    protected $casts = [
        'price' => 'decimal:2',
        'seats' => 'integer',
    ];

    public function images()
    {
        return $this->hasMany(TrainingImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function videos()
    {
        return $this->hasMany(TrainingVideo::class)->orderBy('sort_order')->orderBy('id');
    }

    public function registrations()
    {
        return $this->hasMany(TrainingRegistration::class);
    }
}
