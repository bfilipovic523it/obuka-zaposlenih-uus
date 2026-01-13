<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Uloga;
use App\Models\Sektor;
use App\Models\Materijal;
use App\Models\Obuka;
use App\Models\Prijava;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrikazObukaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function zaposleni_moze_da_vidi_sve_obuke_na_koje_je_prijavljen()
    {
        $adminUloga = Uloga::create(['naziv' => 'Administrator']);
        $zaposleniUloga = Uloga::create(['naziv' => 'Zaposleni']);

        $sektor = Sektor::create([
            'naziv' => 'IT sektor',
        ]);

        $zaposleni = User::factory()->create([
            'uloga_id' => $zaposleniUloga->id,
            'sektor_id' => $sektor->id,
        ]);

        $materijal = Materijal::create([
            'naziv' => 'Materijal za test obuku',
            'opis' => 'Opis materijala',
            'user_id' => $zaposleni->id,
        ]);

        $obuka1 = Obuka::create([
            'naziv' => 'Obuka A - Test',
            'opis' => 'Opis obuke A',
            'sektor_id' => $sektor->id,
            'materijal_id' => $materijal->id,
            'datum_pocetka' => now(),
            'datum_zavrsetka' => now()->addDays(2),
            'broj_mesta' => 10,
            'user_id' => $zaposleni->id,
        ]);

        $obuka2 = Obuka::create([
            'naziv' => 'Obuka B - Test',
            'opis' => 'Opis obuke B',
            'sektor_id' => $sektor->id,
            'materijal_id' => $materijal->id,
            'datum_pocetka' => now(),
            'datum_zavrsetka' => now()->addDays(3),
            'broj_mesta' => 15,
            'user_id' => $zaposleni->id,
        ]);

        Prijava::create([
            'user_id' => $zaposleni->id,
            'obuka_id' => $obuka1->id,
            'status' => 'aktivna',
        ]);

        Prijava::create([
            'user_id' => $zaposleni->id,
            'obuka_id' => $obuka2->id,
            'status' => 'aktivna',
        ]);

        $response = $this->actingAs($zaposleni)
            ->get(route('zaposleni.moje_obuke')); 

        $response->assertStatus(200);

        $response->assertSee('Obuka A - Test');
        $response->assertSee('Obuka B - Test');
    }
}

