<?php

namespace App\Controllers;
use App\Models\ContactModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();
        $data['product'] = $productModel->where('status', 'active')->findAll();
        
        return view('Frontend/index',$data);
    }
    
    public function aboutUs()
    {
        return view('Frontend/about-us');
    }
    
    public function faq()
    {
        return view('Frontend/faq');
    }
    
    public function termsConditions()
    {
        return view('Frontend/terms-conditions');
    }

    public function privacyPolicy()
    {
        return view('Frontend/privacy-policy');
    }
    
    public function contactUs()
    {
        return view('Frontend/privacy-policy');
    }

    public function contactSave()
    {
        $model = new ContactModel();

        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email',
            'message' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'message' => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Thank you! Your message has been saved.'
            ]);
        }

        return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'something went wrong please try again.']);
    }
}
