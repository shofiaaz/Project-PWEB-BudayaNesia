<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akun extends Authenticatable
{
    use HasFactory;

    protected $table = 'akun';
    protected $fillable = [
        'username',
        'email',
        'nomor_hp',
        'password',
        'id_role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }
    public function konten(): HasMany
    {
        return $this->hasMany(Konten::class, 'akun_id', 'id');
    }
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'akun_id', 'id');
    }


    public function badgeLevel()
    {
        return $this->hasOne(BadgeLevel::class, 'akun_id');
    }


    public function getApprovedContentCountAttribute()
    {
        return $this->hasMany(Konten::class, 'akun_id')
            ->where('status', 'approved')
            ->count();
    }


    public function getTotalPointsAttribute()
    {
        return $this->badgeLevel ? $this->badgeLevel->poin : 0;
    }

    public function getCurrentBadgeAttribute()
    {
        return $this->badgeLevel ? $this->badgeLevel->status : 'Abdi';
    }
}

