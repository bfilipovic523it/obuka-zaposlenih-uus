<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Obuka;
use App\Models\Prijava;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PrijavaController
 */
final class PrijavaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $prijavas = Prijava::factory()->count(3)->create();

        $response = $this->get(route('prijavas.index'));

        $response->assertOk();
        $response->assertViewIs('prijava.index');
        $response->assertViewHas('prijavas', $prijavas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('prijavas.create'));

        $response->assertOk();
        $response->assertViewIs('prijava.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PrijavaController::class,
            'store',
            \App\Http\Requests\PrijavaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $status = fake()->word();
        $datum = Carbon::parse(fake()->date());
        $user = User::factory()->create();
        $obuka = Obuka::factory()->create();

        $response = $this->post(route('prijavas.store'), [
            'status' => $status,
            'datum' => $datum->toDateString(),
            'user_id' => $user->id,
            'obuka_id' => $obuka->id,
        ]);

        $prijavas = Prijava::query()
            ->where('status', $status)
            ->where('datum', $datum)
            ->where('user_id', $user->id)
            ->where('obuka_id', $obuka->id)
            ->get();
        $this->assertCount(1, $prijavas);
        $prijava = $prijavas->first();

        $response->assertRedirect(route('prijavas.index'));
        $response->assertSessionHas('prijava.id', $prijava->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $prijava = Prijava::factory()->create();

        $response = $this->get(route('prijavas.show', $prijava));

        $response->assertOk();
        $response->assertViewIs('prijava.show');
        $response->assertViewHas('prijava', $prijava);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $prijava = Prijava::factory()->create();

        $response = $this->get(route('prijavas.edit', $prijava));

        $response->assertOk();
        $response->assertViewIs('prijava.edit');
        $response->assertViewHas('prijava', $prijava);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PrijavaController::class,
            'update',
            \App\Http\Requests\PrijavaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $prijava = Prijava::factory()->create();
        $status = fake()->word();
        $datum = Carbon::parse(fake()->date());
        $user = User::factory()->create();
        $obuka = Obuka::factory()->create();

        $response = $this->put(route('prijavas.update', $prijava), [
            'status' => $status,
            'datum' => $datum->toDateString(),
            'user_id' => $user->id,
            'obuka_id' => $obuka->id,
        ]);

        $prijava->refresh();

        $response->assertRedirect(route('prijavas.index'));
        $response->assertSessionHas('prijava.id', $prijava->id);

        $this->assertEquals($status, $prijava->status);
        $this->assertEquals($datum, $prijava->datum);
        $this->assertEquals($user->id, $prijava->user_id);
        $this->assertEquals($obuka->id, $prijava->obuka_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $prijava = Prijava::factory()->create();

        $response = $this->delete(route('prijavas.destroy', $prijava));

        $response->assertRedirect(route('prijavas.index'));

        $this->assertModelMissing($prijava);
    }
}
