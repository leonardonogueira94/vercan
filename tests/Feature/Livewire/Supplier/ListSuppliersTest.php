<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\ListSuppliers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListSuppliersTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListSuppliers::class);

        $component->assertStatus(200);
    }
}
