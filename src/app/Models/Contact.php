<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_content',
        'detail',
    ];

    public function getGenderNameAttribute()
    {
        return config('genders.'.$this->gender);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}