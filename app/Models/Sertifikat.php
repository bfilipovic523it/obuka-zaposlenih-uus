<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertifikat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kod',
        'datum_izdavanja',
        'prijava_id',
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
            'datum_izdavanja' => 'date',
            'prijava_id' => 'integer',
        ];
    }

    public function prijava(): BelongsTo
    {
        return $this->belongsTo(Prijava::class);
    }
}
