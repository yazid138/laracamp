<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price'
    ];

    // public function camBenefit()
    // {
    //     return $this->hasMany(CampBenefit::class);
    // }

    // public function checkout()
    // {
    //     return $this->belongsTo(Checkout::class);
    // }
}
