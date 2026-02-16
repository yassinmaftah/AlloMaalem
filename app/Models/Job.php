<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'budget',
        'city',
        'status',
        'is_urgent',
        'user_id',
        'category_id',
    ];

    public function user(){return $this->belongsTo(User::class);}
    public function category(){return $this->belongsTo(Category::class);}
    public function applications(){return $this->hasMany(Application::class);}
    public function review(){return $this->hasOne(Review::class);}
}
