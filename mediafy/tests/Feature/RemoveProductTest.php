<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Title;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;


class RemoveProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_remove_product(): void
    {

        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Exempel data
        $product = Product::create([
            'title_id' => 1,
            'platform_id' => 1,
            'price' => 100,
            'stock' => 10,
        ]);


        $response = $this->delete(route('delete', ['id' => $product->id]));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
