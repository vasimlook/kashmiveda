<?= $this->extend('User/theme/default') ?>

<?= $this->section('title') ?>
Withdrawal
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Withdrawal Request</h5>
                        </div>
                        <div class="preview-block">
                            <form method="POST" action="<?= url_to('user_withdrawal') ?>">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="amount">Amount</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="amount" placeholder="Enter your amount" name="amount" value="<?= old('amount') ?>" autofocus>
                                            <?php if (session('errors.amount')) : ?>
                                                <span class="error">
                                                    <?= session('errors.amount') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="custom-control custom-control-sm custom-radio pro-control custom-control-full checked">
                                            <input type="radio" class="custom-control-input" name="payment_method" id="bank" value="bank">
                                            <label class="custom-control-label" for="bank">
                                                <span class="d-flex flex-column align-items-center px-sm-3">
                                                    <span class="w-50">
                                                        <img src="<?= base_url('uploads/common/image/bank.png')?>" />
                                                    </span>
                                                    <span class="lead-text mb-1 mt-3">Bank</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php if(!empty($user['g_pay'])) { ?>
                                        <div class="col-12 col-md-4">
                                            <div class="custom-control custom-control-sm custom-radio pro-control custom-control-full checked">
                                                <input type="radio" class="custom-control-input" name="payment_method" id="g_pay" value="g_pay">
                                                <label class="custom-control-label" for="g_pay">
                                                    <span class="d-flex flex-column align-items-center px-sm-3">
                                                        <span class="w-50">
                                                            <img src="<?= base_url('uploads/common/image/gpay.png')?>" />
                                                        </span>
                                                        <span class="lead-text mb-1 mt-3">(<?= $user['g_pay'] ?>)</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($user['phone_pay'])) { ?>
                                        <div class="col-12 col-md-4">
                                            <div class="custom-control custom-control-sm custom-radio pro-control custom-control-full checked">
                                                <input type="radio" class="custom-control-input" name="payment_method" id="phone_pay" value="phone_pay">
                                                <label class="custom-control-label" for="phone_pay">
                                                    <span class="d-flex flex-column align-items-center px-sm-3">
                                                        <span class="w-50">
                                                            <img src="<?= base_url('uploads/common/image/5F259F.svg')?>" />
                                                        </span>
                                                        <span class="lead-text mb-1 mt-3">(<?= $user['phone_pay'] ?>)</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (session('errors.payment_method')) : ?>
                                        <span class="error text-danger">
                                            <?= session('errors.payment_method') ?>
                                        </span>
                                    <?php endif; ?>
                                </div><br>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Submit request
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="nk-block-head">
                    <div class="nk-block-head-content row">
                        <div class="col-8">
                            <h4 class="nk-block-title">Withdrawal History</h4>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <table class="own-datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
                    url: "<?= url_to('user_withdrawal_history_list') ?>",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: true,
                        searchable: false
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
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });
    </script>
<?= $this->endSection() ?>