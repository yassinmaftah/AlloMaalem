<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'job_id',
        'reviewer_id',
        'reviewed_id',
    ];

    public function job(){return $this->belongsTo(Job::class);}
    public function reviewer(){return $this->belongsTo(User::class, 'reviewer_id');}
    public function reviewed(){return $this->belongsTo(User::class, 'reviewed_id');}
}
