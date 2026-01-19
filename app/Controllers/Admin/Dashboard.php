<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\ContactModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('Admin/dashboard');
    }

    public function contactInquiryList()
    {
        if ($this->request->isAJAX()) {
            $inquiryList = new ContactModel();

            return DataTable::of($inquiryList)
                ->addNumbering('DT_RowIndex')
                ->edit('created_at', function ($row) {
                    return date('d M Y h:i A', strtotime($row->created_at));
                })
                ->toJson(true);
        }

        return view('Admin/contact-inquiry');
    }
}
