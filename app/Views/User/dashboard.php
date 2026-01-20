<?= $this->extend('User/theme/default') ?>

<?= $this->section('title') ?>
User Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">User Dashboard</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to User Dashboard Template.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-1">
                    <div class="card bg-success">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner p-2">
                                <div class="card-title-group">
                                    <div class="col-12">
                                        <h4 class="text-white latter-space-2 fw-bold">Referral Link <em class="icon ni ni-share text-white"></em> <button class="btn btn-xs bg-primary text-white float-end" style="border-radius:5px;" onclick="CopyToClipboardRefLink('copy_link');return false;">Copy Link&nbsp;<em class="icon ni ni-copy"></em></button></h4>
                                        <p id="copy_link" class="text-white" style="font-size: 12px;"><?= url_to('user_register_ref',$user['user_code']) ?></p>
                                    </div>
                                </div>
                                <div class="data p-1 w-100 bg-light" style="border-radius:8px;">
                                    <h6 class="text-dark latter-space-2 fw-bold text-center justify-center align-center">
                                        Referral Code &nbsp;
                                        <span class="round-highlight p-1">
                                            <?= $user['user_code'] ?>
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jsFunction') ?>
<script>
    window.CopyToClipboardRefLink = function(id) {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        toastr.clear();
        NioApp.Toast('Copied Success', 'success', {
            position: 'top-center',
            timeOut: 5000,
            showDuration: 300
        });
    }
</script>
<?= $this->endSection() ?>