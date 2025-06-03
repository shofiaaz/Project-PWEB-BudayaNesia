<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'konten';

    protected $fillable = [
        'thumbnail',
        'judul',
        'isi',
        'kategori',
        'asal',
        'status',
        'akun_id',
        'views_count',
    ];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id');
    }
}
