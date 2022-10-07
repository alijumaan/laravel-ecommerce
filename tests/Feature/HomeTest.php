<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_coupon_is_null_in_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $coupon = Coupon::active()->public()->first();

        // Assert function to test whether given
        // coupon is null or not
        $this->assertNull(
            $coupon,
            "coupon is null or not"
        );
    }

    public function test_coupon_is_not_null_in_homepage()
    {
        Coupon::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $coupon = Coupon::active()->public()->first();

        $this->assertNotNull(
            $coupon,
            "coupon is not null"
        );
    }

    public function test_categories_is_empty_in_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $categories = Category::select('slug', 'cover', 'name')
            ->active()
            ->whereParentId(null)
            ->limit(4)
            ->get();

        $this->assertEmpty(
            $categories,
            "categories is empty"
        );
    }

    public function test_show_categories_in_homepage()
    {
        Category::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        $categories = Category::select('slug', 'cover', 'name')
            ->active()
            ->whereParentId(null)
            ->limit(4)
            ->get();

        $this->assertNotEmpty(
            $categories,
            "categories is not empty"
        );
    }
}
