<?= $this->extend('User/theme/default') ?>

<?= $this->section('title') ?>
My Team
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
                                    <h4 class="nk-block-title">Level 1</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="own-datatable-init-export nowrap table" id="table-level-1" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>User Code </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content row">
                                <div class="col-8">
                                    <h4 class="nk-block-title">Level 2</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="own-datatable-init-export nowrap table" id="table-level-2" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>User Code </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content row">
                                <div class="col-8">
                                    <h4 class="nk-block-title">Level 3</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="own-datatable-init-export nowrap table" id="table-level-3" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>User Code </th>
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
    $(document).ready(function () {
        const tableColumns = [
            { data: 'DT_RowIndex', name: 'id', orderable: true, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'user_code', name: 'user_code' },
        ];

        function initTeamTable(selector, level) {
            return NioApp.DataTable(selector, {
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?= url_to('user_my_team') ?>",
                    type: "GET",
                    data: {
                        'id': '<?= $id ?>',
                        'level': level
                    }
                },
                columns: tableColumns
            });
        }

        initTeamTable('#table-level-1', 1);
        initTeamTable('#table-level-2', 2);
        initTeamTable('#table-level-3', 3);
    });
</script>
<?= $this->endSection() ?>