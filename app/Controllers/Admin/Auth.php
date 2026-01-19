<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isAdminLoggedIn')) {
            return redirect()->to('admin/dashboard');
        }
        return view('Admin/Auth/login');
    }

    public function loginProcess()
    {
        $rules = [
            'phone' => 'required|numeric|min_length[10]',
            'password' => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new AdminModel();
        $phone = $this->request->getPost('phone');
        $password = (string) $this->request->getPost('password');

        $admin = $model->where('phone', $phone)->first();

        if ($admin && password_verify($password, $admin['password'])) {

            session()->set([
                'admin_id' => $admin['id'],
                'admin_name' => $admin['name'],
                'phone' => $admin['phone'],
                'isAdminLoggedIn' => true,
            ]);

            return redirect()->to('admin/dashboard')->with('success', 'Welcome back, ' . $admin['name']);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid phone or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }

    public function changePassword()
    {
        return view('admin/auth/change_password');
    }

    public function updatePassword()
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        $messages = [
            'current_password' => [
                'required' => 'Please enter your existing password to continue.'
            ],
            'new_password' => [
                'required' => 'You must provide a new password.',
                'min_length' => 'Your new password is too short. Use at least 8 characters.'
            ],
            'confirm_password' => [
                'required' => 'Please re-type your new password.',
                'matches' => 'The confirmation password does not match the new password.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new AdminModel();
        $adminId = session()->get('admin_id');
        $admin = $model->find($adminId);

        if (!password_verify($this->request->getPost('current_password'), $admin['password'])) {
            return redirect()->back()->with('error', 'Current password does not match.');
        }

        $model->update($adminId, [
            'password' => $this->request->getPost('new_password')
        ]);

        return redirect()->to('admin/change-password')->with('success', 'Password updated successfully!');
    }
}
