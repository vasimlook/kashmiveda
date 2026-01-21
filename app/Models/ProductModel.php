<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'image', 'price', 'description', 'level_1_commission', 'level_2_commission', 'level_3_commission', 'status'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $beforeDelete = ['deleteFiles'];

    protected function deleteFiles(array $data)
    {
        $imageModel = new \App\Models\ProductImageModel();

        foreach ($data['id'] as $id) {
            $product = $this->find($id);

            @unlink(FCPATH . 'uploads/product/' . $product['image']);

            $gallery = $imageModel->where('product_id', $id)->findAll();
            foreach ($gallery as $img) {
                @unlink(FCPATH . 'uploads/product/' . $img['image_path']);
            }
        }
        return $data;
    }
}
