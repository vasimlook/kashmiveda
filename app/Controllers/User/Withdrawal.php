<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\WithdrawalModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use Hermawan\DataTables\DataTable;

class Withdrawal extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->where('id', $userId)->first();
        $data['user'] = $user;

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'amount' => [
                    'label' => 'Amount',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => 'Amount no is required',
                        'numeric' => 'Enter valid amount',
                    ],
                ],
                'payment_method' => [
                    'label' => 'Payment Method',
                    'rules' => 'required|in_list[g_pay,bank,phone_pay]',
                    'errors' => [
                        'required' => 'Please select a {field}.',
                        'in_list' => 'Invalid {field} selection.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $amount = $this->request->getPost('amount');
            $payment_method = $this->request->getPost('payment_method');

            if (($payment_method == 'bank' && !empty($user['bank_name']) && !empty($user['ifsc_code']) && !empty($user['acc_no'])) || ($payment_method == 'phone_pay' && !empty($user['phone_pay'])) || ($payment_method == 'g_pay' && !empty($user['g_pay']))) {
                $withdrawalModel = new WithdrawalModel();

                $pendingWithdraw = $withdrawalModel->getPendingWithdraw($userId);

                if (empty($pendingWithdraw)) {
                    if ($amount <= $user['balance']) {

                        if ($payment_method == 'g_pay') {
                            $payment_details = 'Google Pay : ' . $user['g_pay'];
                        } else if ($payment_method == 'phone_pay') {
                            $payment_details = 'Phone Pay : ' . $user['phone_pay'];
                        } else {
                            $payment_details = "";
                            if (!empty($user['bank_name'])) {
                                $payment_details .= "Bank Name : " . $user['bank_name'];
                            }
                            if (!empty($user['bank_holder_name'])) {
                                $payment_details .= "<br>Bank Holder Name : " . $user['bank_holder_name'];
                            }
                            if (!empty($user['ifsc_code'])) {
                                $payment_details .= "<br>IFSC Code : " . $user['ifsc_code'];
                            }
                            if (!empty($user['acc_no'])) {
                                $payment_details .= "<br>Acc. No : " . $user['acc_no'];
                            }
                        }

                        $db = \Config\Database::connect();
                        $db->transStart();

                        $data['user_id'] = $userId;
                        $data['amount'] = $amount;
                        $data['payment_details'] = $payment_details;

                        $withdrawalModel->insert($data);

                        $userModel->updateBalance($userId, $amount, false);

                        $db->transComplete();

                        if ($db->transStatus() === false) {
                            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
                        } else {
                            return redirect()->back()->with('success', 'Your withdrawal request has been submitted.');
                        }

                    } else {
                        return redirect()->back()->with('error', 'You have not enough balance for this request.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Old request is already pending.');
                }
            } else {
                return redirect()->back()->with('error', 'Please add bank details.');
            }
        }

        return view('User/withdrawal/index', $data);
    }

    public function withdrawalHistoryList()
    {
        $withdrawalModel = new WithdrawalModel();

        return DataTable::of($withdrawalModel)
            ->addNumbering('DT_RowIndex')
            ->edit('created_at', function ($row) {
                return date('d M Y h:i A', strtotime($row->created_at));
            })
            ->edit('status', function ($row) {
                if ($row->status == 2) {
                    $status = '<span class="badge bg-danger">Rejected</span>';
                } elseif ($row->status == 1) {
                    $status = '<span class="badge bg-success">Paid</span>';
                } else {
                    $status = '<span class="badge bg-warning">Pending</span>';
                }
                return $status;
            })
            ->toJson(true);
    }
}
