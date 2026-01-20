<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Libraries\SmsLibrary;

class Auth extends BaseController
{
    public function register($referralCode = null)
    {
        if (session()->get('isUserLoggedIn')) {
            return redirect()->to('user/dashboard');
        }
        $data['referralCode'] = $referralCode;

        return view('User/Auth/register',$data);
    }

    public function registerProcess()
    {

        $rules = [
            'name' => 'required|min_length[3]',
            'password' => 'required|min_length[8]',
            'referral_code' => 'permit_empty|is_not_unique[users.user_code]',
            'phone' => [
                'label' => 'Phone Number',
                'rules' => [
                    'required',
                    'regex_match[/^\+?[0-9]{10,13}$/]',
                    function ($value, array $data, ?string &$error) {
                        $userModel = new UserModel();

                        $user = $userModel->where('phone', $value)
                            ->where('otp_verify', 1)
                            ->first();

                        if ($user) {
                            $error = 'This phone number is already registered. Please login instead.';
                            return false;
                        }
                        return true;
                    }
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $refCode = $this->request->getPost('referral_code');
        $parent = null;

        if (!empty($refCode)) {
            $parent = $userModel->where('user_code', $refCode)->first();
        }
        $newUserCode = $this->generateUserCode($userModel);
        $phone = $this->request->getPost('phone');

        $existingUser = $userModel->where('phone', $phone)->first();

        if ($existingUser) {
            $data['id'] = $existingUser['id'];
        }

        $data['name'] = $this->request->getPost('name');
        $data['phone'] = $phone;
        $data['password'] = $this->request->getPost('password');
        $data['user_code'] = $newUserCode;
        $data['referral_code'] = $refCode ?? null;
        $data['level_1'] = $parent['id'] ?? null;
        $data['level_2'] = $parent['level_1'] ?? null;
        $data['level_3'] = $parent['level_2'] ?? null;
        $data['balance'] = 0.00;
        $data['status'] = 1;
        $data['otp_verify'] = 0;

        if ($userModel->save($data)) {

            $userId = $data['id'] ?? $userModel->getInsertID();
            $user = $userModel->where('id', $userId)->first();

            if (date('Y-m-d') == $user['otp_date'] && $user['otp_count'] >= 3) {
                return redirect()->back()->with('error', 'OTP Limit Over.');
            } else {
                $sms = new SmsLibrary();
                $otp = rand(1000, 9999);

                if ($sms->sendOtp($phone, $otp)) {
                    $userModel->update($userId, [
                        'otp_code' => $otp,
                        'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                        'otp_count' => (isset($user['otp_count']) && $user['otp_count'] != '' && date('Y-m-d') == $user['otp_date']) ? ($user['otp_count'] + 1) : 1,
                        'otp_date' => date('Y-m-d'),
                    ]);

                    return redirect()->route('user_verify_otp', [$user['uuid']])->with('success', 'OTP has been sent to your phone.');
                } else {
                    return redirect()->back()->with('error', 'something went wrong please try again');
                }
            }
        }

        return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
    }

    private function generateUserCode($model)
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        do {
            $code = substr(str_shuffle($chars), 0, 6);
            $exists = $model->where('user_code', $code)->first();

        } while ($exists);

        return $code;
    }

    public function verifyOtp($uuid)
    {
        $data['uuid'] = $uuid;

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'otp' => 'required|numeric|exact_length[4]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $otp = $this->request->getPost('otp');

            $userModel = new UserModel();
            $user = $userModel->where([
                'uuid' => $uuid,
                'otp_code' => $otp,
                'otp_expires_at >=' => date('Y-m-d H:i:s')
            ])->first();

            if ($user) {
                $userModel->update($user['id'], [
                    'otp_code' => null,
                    'otp_expires_at' => null,
                    'otp_verify' => 1,
                    'otp_count' => 0,
                    'otp_date' => NULL,
                ]);

                session()->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'phone' => $user['phone'],
                    'isUserLoggedIn' => true,
                ]);

                return redirect()->to('user/dashboard')->with('success', 'Welcome to the network!');
            } else {
                return redirect()->back()->with('error', 'Invalid or expired OTP code.');
            }
        }

        return view('User/Auth/verify-otp', $data);
    }

    public function login()
    {
        if (session()->get('isUserLoggedIn')) {
            return redirect()->to('user/dashboard');
        }
        return view('User/Auth/login');
    }

    public function loginProcess()
    {
        $rules = [
            'phone' => 'required|regex_match[/^\+?[0-9]{10,13}$/]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $phone = $this->request->getPost('phone');
        $password = (string) $this->request->getPost('password');

        $user = $model->where('phone', $phone)->first();

        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'phone' => $user['phone'],
                'isUserLoggedIn' => true,
            ]);

            return redirect()->to('user/dashboard')->with('success', 'Welcome back, ' . $user['name']);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid phone or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('user/login');
    }

    public function changePassword()
    {
        return view('user/auth/change_password');
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

        $model = new UserModel();
        $userId = session()->get('user_id');
        $user = $model->find($userId);

        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Current password does not match.');
        }

        $model->update($userId, [
            'password' => $this->request->getPost('new_password')
        ]);

        return redirect()->to('user/change-password')->with('success', 'Password updated successfully!');
    }

    public function forgotPassword()
    {
        if (session()->get('isUserLoggedIn')) {
            return redirect()->to('user/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'phone' => [
                    'label' => 'Phone Number',
                    'rules' => 'required|numeric|min_length[10]|max_length[10]|is_not_unique[users.phone]',
                    'errors' => [
                        'required' => 'Please enter your phone number.',
                        'numeric' => 'The phone number must contain only digits.',
                        'is_not_unique' => 'This phone number is not registered in our system.',
                        'min_length' => 'Mobile no is not valid',
                        'max_length' => 'Mobile no is not valid',
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            } else {
                $userModel = new UserModel();
                $phone = $this->request->getPost('phone');

                $user = $userModel->where('phone', $phone)->first();
                if ($user) {
                    if (date('Y-m-d') == $user['pwd_date'] && $user['pwd_count'] >= 3) {
                        return redirect()->route('user_login')->with('error', 'Forget Password Limit Over!');
                    } else {
                        $sms = new SmsLibrary();
                        $otp = rand(1000, 9999);

                        if ($sms->sendOtp($phone, $otp)) {
                            $userModel->update($user['id'], [
                                'otp_code' => $otp,
                                'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                                'pwd_date' => date('Y-m-d'),
                                'pwd_count' => (isset($user['pwd_count']) && $user['pwd_count'] != '' && date('Y-m-d') == $user['pwd_date']) ? ($user['pwd_count'] + 1) : 1,
                            ]);

                            return redirect()->route('user_new_password', [$user['uuid']])->with('success', 'OTP has been sent to your phone.');
                        } else {
                            return redirect()->back()->with('error', 'something went wrong please try again');
                        }
                    }
                }
                return redirect()->back()->with('error', 'Phone number not found.');
            }
        }
        return view('User/Auth/forgot-password');
    }

    public function newPassword($uuid)
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'otp' => 'required|numeric|exact_length[4]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $otp = $this->request->getPost('otp');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where([
                'uuid' => $uuid,
                'otp_code' => $otp,
                'otp_expires_at >=' => date('Y-m-d H:i:s')
            ])->first();

            if ($user) {
                $userModel->update($user['id'], [
                    'password' => $password,
                    'otp_code' => null,
                    'otp_expires_at' => null,
                    'pwd_count' => 0,
                    'pwd_date' => null,
                ]);

                return redirect()->route('user_login')->with('success', 'Password reset successful. Please login.');
            } else {
                return redirect()->back()->with('error', 'Invalid or expired OTP code.');
            }
        }

        $data['uuid'] = $uuid;
        return view('User/Auth/new-password', $data);
    }
}
