<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\WithdrawalModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class Withdrawal extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            $withdrawalModel = new WithdrawalModel();

            $withdrawal = $withdrawalModel->select('withdrawals.id,withdrawals.amount,withdrawals.payment_details,withdrawals.status,withdrawals.created_at,withdrawals.updated_at, users.name as user_name, users.phone as user_phone')
                ->join('users', 'users.id = withdrawals.user_id');

            return DataTable::of($withdrawal)
                ->addNumbering('DT_RowIndex')
                ->add('action', function ($row) {
                    if ($row->status == 0) {
                        return '<a href="'.url_to('admin_accept_reject_withdrawal_request','1',$row->id).'" class="btn btn-sm btn-info">Accept&nbsp;<em class="icon ni ni-check"></em></a>&nbsp;&nbsp;<a href="'.url_to('admin_accept_reject_withdrawal_request','2',$row->id).'" class="btn btn-sm btn-danger">Reject&nbsp;<em class="icon ni ni-cross"></em></a>';
                    } else {
                        return '';
                    }
                })
                ->edit('amount', function ($row) {
                    return $row->amount;
                })
                ->edit('payment_details', function ($row) {
                    return $row->payment_details;
                })
                ->edit('created_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->created_at));
                })
                ->edit('updated_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->updated_at));
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

        return view('Admin/withdrawal/index');
    }

    public function acceptRejectWithdrawal($status = 0, $withdrawal_id = 0)
    {
        $adminId = session()->get('admin_id');

        $withdrawalModel = new WithdrawalModel();
        $withdrawal = $withdrawalModel->where('id',$withdrawal_id)->first();

        if(!empty($withdrawal) && $withdrawal['accept_by'] == 0)
        {
            $db = \Config\Database::connect();
            $db->transStart();

            $withdrawalModel->update($withdrawal_id, [
                'status' => $status,
                'accept_by' => $adminId,
                'accept_date' => date('Y-m-d H:i:s'),
            ]);
            
            $userModel = new UserModel();
            if($status == 2)
            {
                $userModel->updateBalance($withdrawal['user_id'], $withdrawal['amount'], true);
                $message = "Withdrawal rejected";
            }
            if($status == 1)
            {
                $userModel->updateBalance($withdrawal['user_id'], $withdrawal['amount'], true, 'total_withdrawal');
                $message = "Withdrawal accepted";
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            } else {
                return redirect()->back()->with('success', $message);
            }
        }
        else
        {
            return redirect()->back()->with('error', 'something went wrong please try again.');
        }
    }
}
