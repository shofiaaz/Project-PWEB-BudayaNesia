<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeLevel extends Model
{
    use HasFactory;

    protected $table = 'badge_levels';

    protected $fillable = [
        'akun_id',
        'poin',
        'status',
        'konten_approved'
    ];

    protected $casts = [
        'poin' => 'integer',
        'konten_approved' => 'integer',
    ];

    /**
     * Relationship with Akun model
     */
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    /**
     * Get badge icon based on status
     */
    public function getBadgeIconAttribute()
    {
        $icons = [
            'Abdi' => 'fas fa-user',
            'Panewu' => 'fas fa-user-shield',
            'Adipati' => 'fas fa-crown',
            'Mahapatih' => 'fas fa-chess-queen',
            'Sultan' => 'fas fa-gem',
        ];

        return $icons[$this->status] ?? 'fas fa-user';
    }

    /**
     * Get badge color based on status
     */
    public function getBadgeColorAttribute()
    {
        $colors = [
            'Abdi' => 'from-gray-300 to-gray-400',
            'Panewu' => 'from-yellow-200 to-yellow-400',
            'Adipati' => 'from-blue-300 to-blue-500',
            'Mahapatih' => 'from-purple-300 to-purple-500',
            'Sultan' => 'from-red-400 to-budanes-darker',
        ];

        return $colors[$this->status] ?? 'from-gray-300 to-gray-400';
    }

    /**
     * Get badge level number
     */
    public function getBadgeLevelAttribute()
    {
        $levels = [
            'Abdi' => 1,
            'Panewu' => 2,
            'Adipati' => 3,
            'Mahapatih' => 4,
            'Sultan' => 5,
        ];

        return $levels[$this->status] ?? 1;
    }
}
