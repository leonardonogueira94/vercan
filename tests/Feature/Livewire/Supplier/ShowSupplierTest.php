<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\ShowSupplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowSupplierTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ShowSupplier::class);

        $component->assertStatus(200);
    }
}
