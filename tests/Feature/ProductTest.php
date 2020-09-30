<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_can_create_a_product()
    {
        $brand = new Brand();
        $brand->name = 'it4sport';
        $brand->save();

        $product = new Product();
        $product->name = 'PhoenixII';
        $product->brand()->associate($brand);
        $product->save();

        $this->assertEquals(1, Brand::count());
        $this->assertEquals(1, Product::count());
    }

    /** @test **/
    public function it_can_create_a_brand()
    {
        $brand = new Brand();
        $brand->name = 'it4sport';
        $brand->save();

        $categorie = new Category();
        $categorie->name = 'Lorem Ipsum';
        $brand->categories()->save($categorie);

        $this->assertEquals(1, $categorie->brands()->count());
        //$this->assertEquals(1, $categorie->products()->count());
        $this->assertEquals(1, Category::count());
    }
}
