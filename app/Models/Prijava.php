<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prijava;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prijava extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'datum',
        'user_id',
        'obuka_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'datum' => 'date',
            'user_id' => 'integer',
            'obuka_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function obuka(): BelongsTo
    {
        return $this->belongsTo(Obuka::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }

}
