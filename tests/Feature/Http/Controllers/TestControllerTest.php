<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Obuka;
use App\Models\Prijava;
use App\Models\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TestController
 */
final class TestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tests = Test::factory()->count(3)->create();

        $response = $this->get(route('tests.index'));

        $response->assertOk();
        $response->assertViewIs('test.index');
        $response->assertViewHas('tests', $tests);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('tests.create'));

        $response->assertOk();
        $response->assertViewIs('test.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TestController::class,
            'store',
            \App\Http\Requests\TestStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $ocena = fake()->numberBetween(-10000, 10000);
        $prijava = Prijava::factory()->create();
        $obuka = Obuka::factory()->create();

        $response = $this->post(route('tests.store'), [
            'ocena' => $ocena,
            'prijava_id' => $prijava->id,
            'obuka_id' => $obuka->id,
        ]);

        $tests = Test::query()
            ->where('ocena', $ocena)
            ->where('prijava_id', $prijava->id)
            ->where('obuka_id', $obuka->id)
            ->get();
        $this->assertCount(1, $tests);
        $test = $tests->first();

        $response->assertRedirect(route('tests.index'));
        $response->assertSessionHas('test.id', $test->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $test = Test::factory()->create();

        $response = $this->get(route('tests.show', $test));

        $response->assertOk();
        $response->assertViewIs('test.show');
        $response->assertViewHas('test', $test);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $test = Test::factory()->create();

        $response = $this->get(route('tests.edit', $test));

        $response->assertOk();
        $response->assertViewIs('test.edit');
        $response->assertViewHas('test', $test);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TestController::class,
            'update',
            \App\Http\Requests\TestUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $test = Test::factory()->create();
        $ocena = fake()->numberBetween(-10000, 10000);
        $prijava = Prijava::factory()->create();
        $obuka = Obuka::factory()->create();

        $response = $this->put(route('tests.update', $test), [
            'ocena' => $ocena,
            'prijava_id' => $prijava->id,
            'obuka_id' => $obuka->id,
        ]);

        $test->refresh();

        $response->assertRedirect(route('tests.index'));
        $response->assertSessionHas('test.id', $test->id);

        $this->assertEquals($ocena, $test->ocena);
        $this->assertEquals($prijava->id, $test->prijava_id);
        $this->assertEquals($obuka->id, $test->obuka_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $test = Test::factory()->create();

        $response = $this->delete(route('tests.destroy', $test));

        $response->assertRedirect(route('tests.index'));

        $this->assertModelMissing($test);
    }
}
