<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\CreateSupplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateSupplierTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CreateSupplier::class);

        $component->assertStatus(200);
    }
}
