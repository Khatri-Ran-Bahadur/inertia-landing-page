<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title', 'description'];

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i'
    ];


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
