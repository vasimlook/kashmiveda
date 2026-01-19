<?= $this->extend('User/theme/default') ?>

<?= $this->section('title') ?>
Bank Detail
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="card card-bordered card-preview col-md-6 col-12">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Update Bank Detail</h5>
                        </div>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="preview-block">
                            <form method="POST" action="<?= url_to('user_bank_detail') ?>">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Bank Name</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your bank name" name="bank_name" value="<?= old('bank_name',$user['bank_name']) ?>" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Bank Holder Name</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your bank holder name" name="bank_holder_name" value="<?= old('bank_holder_name',$user['bank_holder_name']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">IFSC Code</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your IFSC Code" name="ifsc_code" value="<?= old('ifsc_code',$user['ifsc_code']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Account No</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your Account No" name="acc_no" value="<?= old('acc_no',$user['acc_no']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Phonepay Upi</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your Phonepay Upi" name="phone_pay" value="<?= old('phone_pay',$user['phone_pay']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Gpay Upi</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your Gpay Upi" name="g_pay" value="<?= old('g_pay',$user['g_pay']) ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                Update Bank Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>