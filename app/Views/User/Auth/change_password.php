<?= $this->extend('User/theme/default') ?>

<?= $this->section('title') ?>
Change Password
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="card card-bordered card-preview col-md-6 col-12">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Change Password</h5>
                        </div>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="preview-block">
                            <form method="POST" action="<?= url_to('user_update_password') ?>">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="current_password">Current Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="current_password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="current_password" placeholder="Enter your Current Password" name="current_password">
                                            <?php if(isset(session('errors')['current_password'])): ?>
                                                <small class="error"><?= session('errors')['current_password'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">New Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your New Password" name="new_password">
                                            <?php if(isset(session('errors')['new_password'])): ?>
                                                <small class="error"><?= session('errors')['new_password'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password_confirmation">Confirmed Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password_confirmation" placeholder="Enter your Confirmed Password" name="confirm_password">
                                            <?php if(isset(session('errors')['confirm_password'])): ?>
                                                <small class="error"><?= session('errors')['confirm_password'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                Update Password
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