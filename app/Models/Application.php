<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'proposed_price',
        'message',
        'status',
        'job_id',
        'user_id',
    ];

    public function job(){return $this->belongsTo(Job::class);}
    public function user(){return $this->belongsTo(User::class);}
}
