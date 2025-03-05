<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class EditTest extends TestCase
{
    use RefreshDatabase;
    public function test_edit_product_admin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $title = \App\Models\Title::factory()->create(['name' => 'Original Product']);

        $platform = \App\Models\Platform::factory()->create(['type' => 'Xbox']);

        $product = Product::factory()->create([
            'title_id' => $title->id,
            'platform_id' => $platform->id,
            'price' => 50,
            'stock' => 20
        ]);

        $data = [
            'title' => 'New Product',
            'platforms' => ['Xbox'],
            'price' => 70,
            'stock' => 100
        ];

        $response = $this->put("/panel/product/{$product->id}/update", $data);

        $updatedProduct = Product::find($product->id);

        $this->assertEquals(70, $updatedProduct->price);
        $this->assertEquals(100, $updatedProduct->stock);

        $this->assertDatabaseHas('titles', [
            'id' => $title->id,
            'name' => 'New Product'
        ]);

        $response->assertRedirect('/panel');
    }
}
