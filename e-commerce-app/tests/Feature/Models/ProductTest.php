<?php

namespace Tests\Feature\Models;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testProductBelongsToCategory()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $productCategory = $product->category;

        $this->assertInstanceOf(Category::class, $productCategory);
        $this->assertEquals($category->id, $productCategory->id);
        $this->assertEquals($category->name, $productCategory->name);
    }

    public function testProductHasManyCartItems()
    {
        $product = Product::factory()->create();

        $cart1 = Cart::factory()->create();
        $cart2 = Cart::factory()->create();

        $cartItem1 = CartItem::factory()->create([
            'cart_id' => $cart1->id,
            'product_id' => $product->id,
        ]);

        $cartItem2 = CartItem::factory()->create([
            'cart_id' => $cart2->id,
            'product_id' => $product->id,
        ]);

        $productCartItems = $product->cartItems;

        $this->assertCount(2, $productCartItems);
        $this->assertTrue($productCartItems->contains($cartItem1));
        $this->assertTrue($productCartItems->contains($cartItem2));
    }

    public function testProductPriceIsCastToDecimal()
    {
        $product = Product::factory()->create([
            'price' => 199.99,
        ]);

        $price = $product->price;

        $this->assertIsString($price);
        $this->assertEquals('199.99', $price);

        $product->price = 49.5;
        $product->save();
        $product->refresh();

        $this->assertEquals('49.50', $product->price);
    }
}
