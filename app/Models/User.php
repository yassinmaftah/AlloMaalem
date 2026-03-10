<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'avatar',
        'bio',
        'speciality',
        'is_verified',
        'is_baned',
        'city_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function jobs(){return $this->hasMany(Job::class);}
    public function applications(){return $this->hasMany(Application::class);}
    public function reviewsWritten(){return $this->hasMany(Review::class, 'reviewer_id');}
    public function reviewsReceived(){return $this->hasMany(Review::class, 'reviewed_id');}
    public function city(){return $this->belongsTo(City::class);}
    public function getRememberTokenName()
    {
        return null;
    }
}
