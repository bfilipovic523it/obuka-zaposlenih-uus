<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Materijal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaterijalController
 */
final class MaterijalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $materijals = Materijal::factory()->count(3)->create();

        $response = $this->get(route('materijals.index'));

        $response->assertOk();
        $response->assertViewIs('materijal.index');
        $response->assertViewHas('materijals', $materijals);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('materijals.create'));

        $response->assertOk();
        $response->assertViewIs('materijal.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterijalController::class,
            'store',
            \App\Http\Requests\MaterijalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $user = User::factory()->create();

        $response = $this->post(route('materijals.store'), [
            'naziv' => $naziv,
            'user_id' => $user->id,
        ]);

        $materijals = Materijal::query()
            ->where('naziv', $naziv)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $materijals);
        $materijal = $materijals->first();

        $response->assertRedirect(route('materijals.index'));
        $response->assertSessionHas('materijal.id', $materijal->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $materijal = Materijal::factory()->create();

        $response = $this->get(route('materijals.show', $materijal));

        $response->assertOk();
        $response->assertViewIs('materijal.show');
        $response->assertViewHas('materijal', $materijal);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $materijal = Materijal::factory()->create();

        $response = $this->get(route('materijals.edit', $materijal));

        $response->assertOk();
        $response->assertViewIs('materijal.edit');
        $response->assertViewHas('materijal', $materijal);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterijalController::class,
            'update',
            \App\Http\Requests\MaterijalUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $materijal = Materijal::factory()->create();
        $naziv = fake()->word();
        $user = User::factory()->create();

        $response = $this->put(route('materijals.update', $materijal), [
            'naziv' => $naziv,
            'user_id' => $user->id,
        ]);

        $materijal->refresh();

        $response->assertRedirect(route('materijals.index'));
        $response->assertSessionHas('materijal.id', $materijal->id);

        $this->assertEquals($naziv, $materijal->naziv);
        $this->assertEquals($user->id, $materijal->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $materijal = Materijal::factory()->create();

        $response = $this->delete(route('materijals.destroy', $materijal));

        $response->assertRedirect(route('materijals.index'));

        $this->assertModelMissing($materijal);
    }
}
