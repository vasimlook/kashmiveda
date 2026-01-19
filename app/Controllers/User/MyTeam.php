<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\UserModel;

class MyTeam extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX())
        {
            $id = $this->request->getGet('id');
            $level = $this->request->getGet('level');
            $column = "level_" . $level;

            $userModel = new UserModel();
            $user = $userModel->select('id,name,phone,user_code,status')
                ->where($column, $id);

            return DataTable::of($user)
                ->addNumbering('DT_RowIndex')
                ->toJson(true);
        }

        $data['id'] = session()->get('user_id');
        return view('User/my-team/index',$data);
    }
}
