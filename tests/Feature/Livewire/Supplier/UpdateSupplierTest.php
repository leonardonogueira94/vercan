<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\UpdateSupplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateSupplierTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(UpdateSupplier::class);

        $component->assertStatus(200);
    }
}
