<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            $userModel = new UserModel();

            return DataTable::of($userModel)
                ->addNumbering('DT_RowIndex')
                ->add('action', function ($row) {
                    return '<a href="' . url_to('admin_user_team', $row->uuid) . '" class="btn btn-sm btn-info">View Team</a>';
                })
                ->edit('created_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->created_at));
                })
                ->edit('updated_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->updated_at));
                })
                ->edit('status', function ($row) {
                    $check_status = "";
                    if ($row->status == 1) {
                        $check_status = 'checked';
                    }

                    return '<div class="custom-control custom-switch">
                            <input type="checkbox" name="status" class="custom-control-input" onclick="update_status(' . $row->id . ')" id="status_' . $row->id . '" ' . $check_status . ' value="' . $row->id . '">
                            <label class="custom-control-label" for="status_' . $row->id . '"></label>
                        </div>';
                })
                ->toJson(true);
        }

        return view('Admin/user/index');
    }

    public function teamList($uuid = null)
    {
        if ($uuid === null) {
            return redirect()->to('/admin/users')->with('error', 'User not found');
        }

        $userModel = new UserModel();
        $user = $userModel->findByUuid($uuid);

        $data['user'] = $user;

        return view('admin/user/team_list', $data);
    }

    public function teamListLevelWise()
    {
        $id = $this->request->getPost('id');
        $level = $this->request->getPost('level');
        $column = "level_" . $level;

        $userModel = new UserModel();
        $user = $userModel->where($column, $id);

        return DataTable::of($user)
            ->addNumbering('DT_RowIndex')
            ->edit('created_at', function ($row) {
                return date('d M Y h:i A', strtotime($row->created_at));
            })
            ->edit('updated_at', function ($row) {
                return date('d M Y h:i A', strtotime($row->updated_at));
            })
            ->edit('status', function ($row) {
                return match ((int) $row->status) {
                    1 => '<span class="badge bg-success">Active</span>',
                    0 => '<span class="badge bg-secondary">Inactive</span>',
                    2 => '<span class="badge bg-danger">Banned</span>',
                    default => '<span class="badge bg-dark">Unknown</span>',
                };
            })
            ->toJson(true);

    }

    public function updateStatus()
    {
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $userModel = new UserModel();

        if ($userModel->update($id, ['status' => $status])) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
