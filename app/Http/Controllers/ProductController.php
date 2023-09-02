<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    //to get all the product details
    public function getProducts() {
        $products = $this->productRepository->getAllProducts();
        return view('products.view_products', ['products' => $products]);
    }

    //to add new product
    public function addProducts() {
        return view('products.add_products');
    }

    //store product
    public function storeProduct(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required | decimal:0,2',
            'qty' => 'required | numeric'
        ]);

        $this->productRepository->saveProduct($data);

        return redirect(route('products.view_products'));
    }

    //edit product
    public function editProducts($id) {
        $product = $this->productRepository->findProduct($id);
        return view('products.edit_products', ['product' => $product]);
    }

    //update product
    public function updateProducts(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required | decimal:0,2',
            'qty' => 'required | numeric'
        ]);

        $this->productRepository->updateProduct($request->all(), $id);

        return redirect(route('products.view_products'))->with('success', 'Product Updated Successfully');
    }

    //delete product
    public function deleteProducts($id) {
        $this->productRepository->destroyProduct($id);
        return redirect(route('products.view_products'))->with('success', 'Product Deleted Successfully');
    }
    
}
