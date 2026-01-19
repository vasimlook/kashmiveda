<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">
    <!-- Page Title  -->
    <title><?= $this->renderSection('title') ?? 'Admin Panel' ?> | <?= APP_NAME ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashlite.css?ver=3.2.3') ?>">
    <link id="skin-default" rel="stylesheet" href="<?= base_url('assets/css/theme.css?ver=3.2.3') ?>">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?= $this->include('Admin/theme/sidebar') ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?= $this->include('Admin/theme/header') ?>
                <!-- main header @e -->
                <!-- content @s -->
                <?= $this->renderSection('content') ?>
                <!-- content @e -->
                <!-- footer @s -->
                <?= $this->include('Admin/theme/footer') ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    
    <!-- JavaScript -->
    <script src="<?= base_url('assets/js/bundle.js?ver=3.2.3') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js?ver=3.2.3') ?>"></script>
    <script src="<?= base_url('assets/js/charts/gd-default.js?ver=3.2.3') ?>"></script>
    <?= $this->renderSection('jsFile') ?>
    <?= $this->renderSection('jsFunction') ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            NioApp.Toast("<?= session()->getFlashdata('success') ?>", 'success', {
                position: 'top-right'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            NioApp.Toast("<?= session()->getFlashdata('error') ?>", 'error', {
                position: 'top-right'
            });
        </script>
    <?php endif; ?>
</body>

</html>