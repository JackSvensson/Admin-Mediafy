<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Title;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;


class AddProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_add_product_admin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Prepare the input data to simulate the form submission
        $data = [
            'title' => 'New Product', // The title input field
            'platforms' => ['Xbox'], // The platforms checkbox input (array)
            'price' => 70, // The price input field
            'stock' => 100, // The stock input field
        ];

        $response = $this->post('/product', $data);
        $response->assertRedirect('/panel');
        $response->assertSessionHas('success', 'Product created successfully');
        $this->assertDatabaseHas('titles', ['name' => 'New Product']);

        foreach ($data['platforms'] as $platformType) {
            $this->assertDatabaseHas('platforms', ['type' => $platformType]);
        }


        foreach ($data['platforms'] as $platformType) {
            $platform = Platform::where('type', $platformType)->first();
            $this->assertDatabaseHas('products', [
                'title_id' => Title::where('name', 'New Product')->first()->id,
                'platform_id' => $platform->id,
                'price' => $data['price'],
                'stock' => $data['stock'],
            ]);
        }
    }

    public function test_add_product_standard()
    {
        $user = User::factory()->create(['role' => 'standard']);
        $this->actingAs($user);

        // Prepare the input data to simulate the form submission
        $data = [
            'title' => 'Non existing product', // The title input field
            'platforms' => ['Xbox'], // The platforms checkbox input (array)
            'price' => 70, // The price input field
            'stock' => 100, // The stock input field
        ];

        $response = $this->post('/product', $data);
        $this->assertDatabaseMissing('titles', ['name' => 'Non existing product']);
    }
}
