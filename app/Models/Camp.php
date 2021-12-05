<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    public function getIsRegisteredAttribute()
    {
        if (!Auth::check()) {
            return false;
        }
        return Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists();
    }
}
