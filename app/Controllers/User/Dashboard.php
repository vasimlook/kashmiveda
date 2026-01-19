<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('User/dashboard');
    }

    public function bankDetail()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        if ($this->request->getMethod() === 'POST') {
            $updateData = [
                'bank_name' => $this->request->getPost('bank_name'),
                'bank_holder_name' => $this->request->getPost('bank_holder_name'),
                'ifsc_code' => strtoupper($this->request->getPost('ifsc_code')),
                'acc_no' => $this->request->getPost('acc_no'),
                'phone_pay' => $this->request->getPost('phone_pay'),
                'g_pay' => $this->request->getPost('g_pay'),
            ];

            if ($userModel->update($userId, $updateData)) {
                return redirect()->back()->with('success', 'Bank details updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update bank details.');
            }
        }

        $data['user'] = $userModel->where('id', $userId)->first();

        return view('User/bank-detail', $data);
    }
}
