<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sektor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SektorController
 */
final class SektorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sektors = Sektor::factory()->count(3)->create();

        $response = $this->get(route('sektors.index'));

        $response->assertOk();
        $response->assertViewIs('sektor.index');
        $response->assertViewHas('sektors', $sektors);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('sektors.create'));

        $response->assertOk();
        $response->assertViewIs('sektor.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SektorController::class,
            'store',
            \App\Http\Requests\SektorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();

        $response = $this->post(route('sektors.store'), [
            'naziv' => $naziv,
        ]);

        $sektors = Sektor::query()
            ->where('naziv', $naziv)
            ->get();
        $this->assertCount(1, $sektors);
        $sektor = $sektors->first();

        $response->assertRedirect(route('sektors.index'));
        $response->assertSessionHas('sektor.id', $sektor->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $sektor = Sektor::factory()->create();

        $response = $this->get(route('sektors.show', $sektor));

        $response->assertOk();
        $response->assertViewIs('sektor.show');
        $response->assertViewHas('sektor', $sektor);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $sektor = Sektor::factory()->create();

        $response = $this->get(route('sektors.edit', $sektor));

        $response->assertOk();
        $response->assertViewIs('sektor.edit');
        $response->assertViewHas('sektor', $sektor);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SektorController::class,
            'update',
            \App\Http\Requests\SektorUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $sektor = Sektor::factory()->create();
        $naziv = fake()->word();

        $response = $this->put(route('sektors.update', $sektor), [
            'naziv' => $naziv,
        ]);

        $sektor->refresh();

        $response->assertRedirect(route('sektors.index'));
        $response->assertSessionHas('sektor.id', $sektor->id);

        $this->assertEquals($naziv, $sektor->naziv);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $sektor = Sektor::factory()->create();

        $response = $this->delete(route('sektors.destroy', $sektor));

        $response->assertRedirect(route('sektors.index'));

        $this->assertModelMissing($sektor);
    }
}
