<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'akun_id',
        'thumbnail',
        'judul',
        'jadwal',
        'tempat',
        'isi',
        'kategori',
        'status',
        'views_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jadwal' => 'datetime',
    ];

    /**
     * Get the akun that owns the event.
     */
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
