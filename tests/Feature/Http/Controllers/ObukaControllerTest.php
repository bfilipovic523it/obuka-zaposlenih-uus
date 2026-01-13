<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Materijal;
use App\Models\Obuka;
use App\Models\Sektor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ObukaController
 */
final class ObukaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $obukas = Obuka::factory()->count(3)->create();

        $response = $this->get(route('obukas.index'));

        $response->assertOk();
        $response->assertViewIs('obuka.index');
        $response->assertViewHas('obukas', $obukas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('obukas.create'));

        $response->assertOk();
        $response->assertViewIs('obuka.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ObukaController::class,
            'store',
            \App\Http\Requests\ObukaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $opis = fake()->text();
        $broj_mesta = fake()->numberBetween(-10000, 10000);
        $datum_pocetka = Carbon::parse(fake()->date());
        $datum_zavrsetka = Carbon::parse(fake()->date());
        $user = User::factory()->create();
        $sektor = Sektor::factory()->create();
        $materijal = Materijal::factory()->create();

        $response = $this->post(route('obukas.store'), [
            'naziv' => $naziv,
            'opis' => $opis,
            'broj_mesta' => $broj_mesta,
            'datum_pocetka' => $datum_pocetka->toDateString(),
            'datum_zavrsetka' => $datum_zavrsetka->toDateString(),
            'user_id' => $user->id,
            'sektor_id' => $sektor->id,
            'materijal_id' => $materijal->id,
        ]);

        $obukas = Obuka::query()
            ->where('naziv', $naziv)
            ->where('opis', $opis)
            ->where('broj_mesta', $broj_mesta)
            ->where('datum_pocetka', $datum_pocetka)
            ->where('datum_zavrsetka', $datum_zavrsetka)
            ->where('user_id', $user->id)
            ->where('sektor_id', $sektor->id)
            ->where('materijal_id', $materijal->id)
            ->get();
        $this->assertCount(1, $obukas);
        $obuka = $obukas->first();

        $response->assertRedirect(route('obukas.index'));
        $response->assertSessionHas('obuka.id', $obuka->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $obuka = Obuka::factory()->create();

        $response = $this->get(route('obukas.show', $obuka));

        $response->assertOk();
        $response->assertViewIs('obuka.show');
        $response->assertViewHas('obuka', $obuka);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $obuka = Obuka::factory()->create();

        $response = $this->get(route('obukas.edit', $obuka));

        $response->assertOk();
        $response->assertViewIs('obuka.edit');
        $response->assertViewHas('obuka', $obuka);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ObukaController::class,
            'update',
            \App\Http\Requests\ObukaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $obuka = Obuka::factory()->create();
        $naziv = fake()->word();
        $opis = fake()->text();
        $broj_mesta = fake()->numberBetween(-10000, 10000);
        $datum_pocetka = Carbon::parse(fake()->date());
        $datum_zavrsetka = Carbon::parse(fake()->date());
        $user = User::factory()->create();
        $sektor = Sektor::factory()->create();
        $materijal = Materijal::factory()->create();

        $response = $this->put(route('obukas.update', $obuka), [
            'naziv' => $naziv,
            'opis' => $opis,
            'broj_mesta' => $broj_mesta,
            'datum_pocetka' => $datum_pocetka->toDateString(),
            'datum_zavrsetka' => $datum_zavrsetka->toDateString(),
            'user_id' => $user->id,
            'sektor_id' => $sektor->id,
            'materijal_id' => $materijal->id,
        ]);

        $obuka->refresh();

        $response->assertRedirect(route('obukas.index'));
        $response->assertSessionHas('obuka.id', $obuka->id);

        $this->assertEquals($naziv, $obuka->naziv);
        $this->assertEquals($opis, $obuka->opis);
        $this->assertEquals($broj_mesta, $obuka->broj_mesta);
        $this->assertEquals($datum_pocetka, $obuka->datum_pocetka);
        $this->assertEquals($datum_zavrsetka, $obuka->datum_zavrsetka);
        $this->assertEquals($user->id, $obuka->user_id);
        $this->assertEquals($sektor->id, $obuka->sektor_id);
        $this->assertEquals($materijal->id, $obuka->materijal_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $obuka = Obuka::factory()->create();

        $response = $this->delete(route('obukas.destroy', $obuka));

        $response->assertRedirect(route('obukas.index'));

        $this->assertModelMissing($obuka);
    }
}
