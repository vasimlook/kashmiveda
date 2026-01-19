<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">

    <title>User Login | <?= APP_NAME ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashlite.css?ver=3.2.3') ?>">
    <link id="skin-default" rel="stylesheet" href="<?= base_url('assets/css/theme.css?ver=3.2.3') ?>">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?= base_url('assets/images/logo.png') ?>" srcset="<?= base_url('assets/images/logo2x.png') ?> 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?= base_url('assets/images/logo-dark.png') ?>" srcset="<?= base_url('assets/images/logo-dark2x.png') ?> 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Forgot password</h4>
                                        <div class="nk-block-des">
                                            <p>If you forgot your password and not receive OTP Then contact to admin.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php if(session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                <?php endif; ?>
                                <form method="POST" action="<?= url_to('user_forgot_password') ?>">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Phone</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your phone no" name="phone" value="<?= old('phone') ?>" autofocus>
                                            <?php if (session('errors.phone')) : ?>
                                                <span class="error">
                                                    <?= session('errors.phone') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"><a href="<?= url_to('user_login') ?>">Return to login</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-start">
                                        <p class="text-soft">&copy; <?= date('Y')?> <?= APP_NAME ?>. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    
    <script src="<?= base_url('assets/js/bundle.js?ver=3.2.3') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js?ver=3.2.3') ?>"></script>
</html>