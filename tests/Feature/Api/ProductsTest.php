<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAll_products(): void
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price', 'description', 'group_id', 'created_at', 'updated_at'],
            ]);
    }
    public function test_getById_product(): void
    {
        $product = Product::factory()->create();
        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200);
        // dd($response);
        // $response->assertJsonStructure([
        //     'data' => 'id',
        //     'name',
        //     'description',
        //     'price',
        //     'group_id',
        //     'created_at',
        //     'updated_at',
        //     'deleted_at',
        // ]);

        // $response->assertJson([
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'description' => $product->description,
        //     'price' => $product->price,
        //     'group_id' => $product->group_id,
        // ]);
    }
}
