<?= $this->extend('Admin/theme/default') ?>

<?= $this->section('title') ?>
User Withdrawal Request
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content row">
                                <div class="col-8">
                                    <h4 class="nk-block-title">Withdrawal Request List</h4>
                                </div>                               
                            </div>
                        </div>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="own-datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Amount </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Bank Details</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jsFile') ?>
    <script src="<?= base_url('assets/js/libs/datatable-btns.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('jsFunction') ?>
    <script>
        $(document).ready(function() {

            NioApp.DataTable('.own-datatable-init-export', {
                responsive: false,
                scrollX: true,
                fixedColumns: {
                    right: 1
                },
                order: [[0, 'desc']],
                buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis'],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?= url_to('admin_withdrawal_request') ?>",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'user_name',
                        name: 'name'
                    },
                    {
                        data: 'user_phone',
                        name: 'phone'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'payment_details',
                        name: 'payment_details',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    }
                ]
            });
        });

        function update_status(id)
        {
            status_val = Number($("#status_"+id).is(":checked"));
            
            $.ajax({
                url: "<?= url_to('admin_user_update_status') ?>",
                type: 'POST',
                data: {
                    'id': id,
                    'status': status_val,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function (result) {
                    if(result.success == true)
                    {
                        NioApp.Toast('Status changed successfully', 'success',{
                            position:'top-center',timeOut:5000,showDuration:300
                        });
                    }
                    else
                    {
                        NioApp.Toast('something went wrong please try again', 'error',{
                            position:'top-center',timeOut:5000,showDuration:300
                        });
                    }
                }
            });
        }
    </script>
<?= $this->endSection() ?>
