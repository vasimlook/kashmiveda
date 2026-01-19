<?= $this->extend('Admin/theme/default') ?>

<?= $this->section('title') ?>
Admin Dashboard
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
                                    <h4 class="nk-block-title">Contact Inquiry List</h4>
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
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Created At</th>
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
                    url: "<?= url_to('admin_contact_inquiry_list') ?>",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });
    </script>
<?= $this->endSection() ?>
