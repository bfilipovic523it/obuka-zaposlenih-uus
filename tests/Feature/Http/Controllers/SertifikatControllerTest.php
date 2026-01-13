<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Prijava;
use App\Models\Sertifikat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SertifikatController
 */
final class SertifikatControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sertifikats = Sertifikat::factory()->count(3)->create();

        $response = $this->get(route('sertifikats.index'));

        $response->assertOk();
        $response->assertViewIs('sertifikat.index');
        $response->assertViewHas('sertifikats', $sertifikats);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('sertifikats.create'));

        $response->assertOk();
        $response->assertViewIs('sertifikat.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SertifikatController::class,
            'store',
            \App\Http\Requests\SertifikatStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $kod = fake()->word();
        $datum_izdavanja = Carbon::parse(fake()->date());
        $prijava = Prijava::factory()->create();

        $response = $this->post(route('sertifikats.store'), [
            'kod' => $kod,
            'datum_izdavanja' => $datum_izdavanja->toDateString(),
            'prijava_id' => $prijava->id,
        ]);

        $sertifikats = Sertifikat::query()
            ->where('kod', $kod)
            ->where('datum_izdavanja', $datum_izdavanja)
            ->where('prijava_id', $prijava->id)
            ->get();
        $this->assertCount(1, $sertifikats);
        $sertifikat = $sertifikats->first();

        $response->assertRedirect(route('sertifikats.index'));
        $response->assertSessionHas('sertifikat.id', $sertifikat->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $sertifikat = Sertifikat::factory()->create();

        $response = $this->get(route('sertifikats.show', $sertifikat));

        $response->assertOk();
        $response->assertViewIs('sertifikat.show');
        $response->assertViewHas('sertifikat', $sertifikat);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $sertifikat = Sertifikat::factory()->create();

        $response = $this->get(route('sertifikats.edit', $sertifikat));

        $response->assertOk();
        $response->assertViewIs('sertifikat.edit');
        $response->assertViewHas('sertifikat', $sertifikat);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SertifikatController::class,
            'update',
            \App\Http\Requests\SertifikatUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $sertifikat = Sertifikat::factory()->create();
        $kod = fake()->word();
        $datum_izdavanja = Carbon::parse(fake()->date());
        $prijava = Prijava::factory()->create();

        $response = $this->put(route('sertifikats.update', $sertifikat), [
            'kod' => $kod,
            'datum_izdavanja' => $datum_izdavanja->toDateString(),
            'prijava_id' => $prijava->id,
        ]);

        $sertifikat->refresh();

        $response->assertRedirect(route('sertifikats.index'));
        $response->assertSessionHas('sertifikat.id', $sertifikat->id);

        $this->assertEquals($kod, $sertifikat->kod);
        $this->assertEquals($datum_izdavanja, $sertifikat->datum_izdavanja);
        $this->assertEquals($prijava->id, $sertifikat->prijava_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $sertifikat = Sertifikat::factory()->create();

        $response = $this->delete(route('sertifikats.destroy', $sertifikat));

        $response->assertRedirect(route('sertifikats.index'));

        $this->assertModelMissing($sertifikat);
    }
}
