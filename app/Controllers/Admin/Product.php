<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class Product extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            $productModel = new ProductModel();

            return DataTable::of($productModel)
                ->addNumbering('DT_RowIndex')
                ->add('action', function ($row) {
                    return '<a class="btn btn-xs bg-dark text-light" href="' . url_to('admin_product_edit', $row->id) . '">Edit&nbsp;<em class="icon ni ni-edit"></em></a>&nbsp;<a href="' . url_to('admin_product_delete', $row->id) . '" class="btn btn-xs text-light bg-danger">Delete <em class="icon ni ni-trash"></em></a>';
                })
                ->edit('price', function ($row) {
                    return $row->price;
                })
                ->edit('name', function ($row) {
                    return '<div class="user-card">
                            <div class="user-avatar"><img height="100%" src="' . base_url('uploads/' . $row->image) . '" alt=""></div>
                            <div class="user-info">
                                <span class="tb-lead">' . $row->name . '</span>
                            </div>
                        </div>';
                })
                ->edit('created_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->created_at));
                })
                ->edit('updated_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->updated_at));
                })
                ->edit('status', function ($row) {
                    if ($row->status == 'active') {
                        $status = '<span class="badge bg-success">Active</span>';
                    } else {
                        $status = '<span class="badge bg-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->toJson(true);
        }

        return view('Admin/product/index');
    }

    public function add()
    {
        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
                'price' => 'required|decimal',
                'level_1_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 1 Commission'
                ],
                'level_2_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 2 Commission'
                ],
                'level_3_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 3 Commission'
                ],
                'description' => 'required',
                'main_image' => [
                    'rules' => 'uploaded[main_image]|is_image[main_image]|mime_in[main_image,image/jpg,image/jpeg,image/png]|max_size[main_image,2048]',
                    'label' => 'Main Product Image'
                ],
                'status' => 'required|in_list[active,inactive]',
            ];

            if (!$this->validate($rules)) {
                // Returns to the form with errors and the old input data
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $productModel = new ProductModel();
            $imageModel = new ProductImageModel();

            $mainImageName = "";
            $mainFile = $this->request->getFile('main_image');
            if ($mainFile->isValid() && !$mainFile->hasMoved()) {
                $mainImageName = $mainFile->getRandomName();
                $mainFile->move(FCPATH . 'uploads/product', $mainImageName);
            }

            $productId = $productModel->insert([
                'name' => $this->request->getPost('name'),
                'image' => 'product/' . $mainImageName,
                'price' => $this->request->getPost('price'),
                'description' => $this->request->getPost('description'),
                'level_1_commission' => $this->request->getPost('level_1_commission'),
                'level_2_commission' => $this->request->getPost('level_2_commission'),
                'level_3_commission' => $this->request->getPost('level_3_commission'),
                'status' => $this->request->getPost('status'),
            ]);

            if ($files = $this->request->getFileMultiple('images')) {
                foreach ($files as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'uploads/product', $newName);
                        $imageModel->insert([
                            'product_id' => $productId,
                            'image_path' => 'product/' . $newName
                        ]);
                    }
                }
            }

            return redirect()->route('admin_product')->with('success', 'Product Created!');
        }

        return view('Admin/product/add');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->delete($id);
        return redirect()->route('admin_product')->with('success', 'Product Deleted');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        $data['product'] = $product;

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
                'price' => 'required|decimal',
                'level_1_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 1 Commission'
                ],
                'level_2_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 2 Commission'
                ],
                'level_3_commission' => [
                    'rules' => 'required|decimal|greater_than_equal_to[0]',
                    'label' => 'Level 3 Commission'
                ],
                'description' => 'required',
                'main_image' => [
                    'rules' => 'permit_empty|is_image[main_image]|mime_in[main_image,image/jpg,image/jpeg,image/png]|max_size[main_image,2048]',
                    'label' => 'Main Product Image'
                ],
                'status' => 'required|in_list[active,inactive]',
            ];

            if (!$this->validate($rules)) {
                // Returns to the form with errors and the old input data
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'description' => $this->request->getPost('description'),
                'level_1_commission' => $this->request->getPost('level_1_commission'),
                'level_2_commission' => $this->request->getPost('level_2_commission'),
                'level_3_commission' => $this->request->getPost('level_3_commission'),
                'status' => $this->request->getPost('status'),
            ];

            $file = $this->request->getFile('main_image');
            if ($file->isValid() && !$file->hasMoved()) {
                // Delete old file if it exists
                if (!empty($product['image']) && file_exists(FCPATH . 'uploads/product/' . $product['image'])) {
                    unlink(FCPATH . 'uploads/product/' . $product['image']);
                }

                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/product', $newName);
                $data['image'] = 'product/' . $newName;
            }

            $productModel->update($id, $data);

            if ($files = $this->request->getFileMultiple('images')) {
                $imageModel = new ProductImageModel();

                $oldImages = $imageModel->where('product_id', $id)->findAll();

                // 2. Delete physical files and DB records
                foreach ($oldImages as $img) {
                    @unlink(FCPATH . 'uploads/product/' . $img['image_path']);
                    $imageModel->delete($img['id']);
                }

                foreach ($files as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'uploads/product', $newName);

                        $imageModel->insert([
                            'product_id' => $id,
                            'image_path' => 'product/' . $newName
                        ]);
                    }
                }

            }

            return redirect()->route('admin_product')->with('success', 'Product Created!');
        }

        return view('Admin/product/edit', $data);
    }
}
