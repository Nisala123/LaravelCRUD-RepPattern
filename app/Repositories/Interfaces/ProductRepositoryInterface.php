<?php 

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface {

    public function getAllProducts();

    public function saveProduct($data);

    public function findProduct($id);

    public function updateProduct($data, $id);

    public function destroyProduct($id);
}

?>