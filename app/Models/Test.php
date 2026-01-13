<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ocena',
        'prijava_id',
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
            'prijava_id' => 'integer',
            'obuka_id' => 'integer',
        ];
    }

    public function prijava(): BelongsTo
    {
        return $this->belongsTo(Prijava::class);
    }

    public function obuka(): BelongsTo
    {
        return $this->belongsTo(Obuka::class);
    }
}
