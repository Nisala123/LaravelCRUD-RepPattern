<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface {

    public function getAllProducts()
    {
        return Product::all();
    }

    public function saveProduct($data)
    {
        return Product::create($data);
    }

    public function findProduct($id) 
    {
        return Product::find($id);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::where('id', $id)->first();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->qty = $data['qty'];
        $product->save();
        
    }

    public function destroyProduct($id)
    {
        $category = Product::find($id);
        $category->delete();
    }

}
?>