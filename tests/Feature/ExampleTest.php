<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        //preparation
        

        //action
        $response = $this->get(route('products.view_products'));

        //predict
        $response->assertStatus(200);
    }

    /** @test */
    public function it_does_not_store_a_product_with_invalid_data()
    {
        // Arrange: Create invalid product data
        $invalidData = [
            'name' => '',
            // Name is required, so this is invalid
            'description' => 'This is a test product.',
            'price' => 'invalid_price',
            // Price should be a valid decimal
            'qty' => 'invalid_qty', // Quantity should be numeric
        ];

        // Act: Send a POST request to the storeProduct route with invalid data
        $response = $this->post(route('products.store'), $invalidData);

        // Assert: Check for validation errors and ensure the database is not modified
        $response->assertSessionHasErrors(['name', 'price', 'qty']);
        $this->assertDatabaseCount('products', 0); // No new product should be added
    }

    public function it_stores_a_product_with_valid_data()
    {
        // Arrange: Create valid product data
        $validData = [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 19.99,
            'qty' => 10,
        ];

        // Act: Send a POST request to the storeProduct route with valid data
        $response = $this->post(route('products.store'), $validData);

        // Assert: Check the response and database for the new product
        $response->assertRedirect(route('products.view_products'));
        $this->assertDatabaseHas('products', $validData);
    }
}
