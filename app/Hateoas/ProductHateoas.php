<?php

namespace App\Hateoas;

use App\Models\Product;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class ProductHateoas
{
    use CreatesLinks;

    public function self(Product $product): ?Link
    {
        return $this->link('products.show', ['stand' => $product->sales_stand_id, 'product' => $product]);
    }

    public function update(Product $product): ?Link
    {
        return $this->link('products.update', ['stand' => $product->sales_stand_id, 'product' => $product]);
    }

    public function delete(Product $product): ?Link
    {
        return $this->link('products.destroy', ['stand' => $product->sales_stand_id, 'product' => $product]);
    }
}
