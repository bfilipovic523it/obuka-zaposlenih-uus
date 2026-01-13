<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prijava;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obuka extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naziv',
        'naziv',
        'opis',
        'sektor_id',
        'user_id',
        'materijal_id',
        'datum_pocetka',
        'datum_zavrsetka',
        'broj_mesta',
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
            'datum_pocetka' => 'date',
            'datum_zavrsetka' => 'date',
            'user_id' => 'integer',
            'sektor_id' => 'integer',
            'materijal_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sektor(): BelongsTo
    {
        return $this->belongsTo(Sektor::class);
    }

    public function materijal(): BelongsTo
    {
        return $this->belongsTo(Materijal::class);
    }

    public function prijave()
    {
        return $this->hasMany(Prijava::class, 'obuka_id');
    }
}
