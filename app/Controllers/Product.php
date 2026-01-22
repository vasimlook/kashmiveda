<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
    public function details($uuid)
    {
        $productModel = new ProductModel();
        $product = $productModel->where('uuid',$uuid)->first();

        $productImageModel = new ProductImageModel();
        $productImage = $productImageModel->getImagesByProduct($product['id']);

        $data['product'] = $product;
        $data['productImage'] = $productImage;

        return view('Frontend/product-details',$data);
    }
}
