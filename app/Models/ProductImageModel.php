<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table            = 'product_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'image_path'];

    /**
     * Get all images for a specific product
     */
    public function getImagesByProduct(int $productId)
    {
        return $this->where('product_id', $productId)->findAll();
    }
}
