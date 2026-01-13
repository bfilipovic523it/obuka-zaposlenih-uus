<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'uloga_id',
        'sektor_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function prijave()
    {
        return $this->hasMany(Prijava::class);
    }

    public function obuke()
    {
        return $this->belongsToMany(Obuka::class, 'prijavas');
    }

    public function uloga(): BelongsTo
    {
        return $this->belongsTo(Uloga::class);
    }

    public function isAdministrator(): bool
    {
        return $this->uloga?->naziv === 'Administrator';
    }

    public function isPredavac(): bool
    {
        return $this->uloga?->naziv === 'Predavac';
    }

    public function isZaposleni(): bool
    {
        return $this->uloga?->naziv === 'Zaposleni';
    }

    public function sektor(): BelongsTo
    {
        return $this->belongsTo(Sektor::class);
    }

    public function isIT(): bool
    {
        return $this->sektor?->naziv === 'IT';
    }

    public function isMarketing_i_prodaja(): bool
    {
        return $this->sektor?->naziv === 'Marketing i prodaja';
    }
}