<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\EditSupplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditSupplierTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(EditSupplier::class);

        $component->assertStatus(200);
    }
}
