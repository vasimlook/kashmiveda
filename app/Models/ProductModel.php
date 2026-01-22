<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['uuid', 'name', 'image', 'price', 'description', 'level_1_commission', 'level_2_commission', 'level_3_commission', 'status'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['generateUUID'];
    protected $beforeDelete = ['deleteFiles'];

    protected function generateUUID(array $data)
    {
        if (!isset($data['data']['uuid'])) {
            $data['data']['uuid'] = $this->uuidv4();
        }
        return $data;
    }

    private function uuidv4()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

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
