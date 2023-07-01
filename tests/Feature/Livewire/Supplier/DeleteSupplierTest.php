<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Supplier\DeleteSupplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteSupplierTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeleteSupplier::class);

        $component->assertStatus(200);
    }
}
