<div class="nk-header nk-header-fluid is-theme">
    <div class="container-xl wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="<?= url_to('home') ?>" class="logo-link">
                    <img class="logo-light logo-img" src="<?= base_url('assets/images/logo.png') ?>" srcset="<?= base_url('assets/images/logo2x.png') ?> 2x" alt="logo">
                    <img class="logo-dark logo-img" src="<?= base_url('assets/images/logo-dark.png') ?>" srcset="<?= base_url('assets/images/logo-dark2x.png') ?> 2x"
                        alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-menu  ms-auto" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="<?= url_to('home') ?>" class="logo-link">
                            <img class="logo-light logo-img" src="<?= base_url('assets/images/logo.png') ?>" srcset="<?= base_url('assets/images/logo2x.png') ?> 2x"
                                alt="logo">
                            <img class="logo-dark logo-img" src="<?= base_url('assets/images/logo-dark.png') ?>"
                                srcset="<?= base_url('assets/images/logo-dark2x.png') ?> 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                                class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item">
                        <a href="<?= url_to('home') ?>" class="nk-menu-link">
                            <span class="nk-menu-text">Home</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?= url_to('about_us') ?>" class="nk-menu-link">
                            <span class="nk-menu-text">About Us</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="<?= url_to('contact_us') ?>" class="nk-menu-link">
                            <span class="nk-menu-text">Contact Us</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="<?= url_to('user_login') ?>" class="nk-menu-link">
                            <span class="nk-menu-text">Sign In</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>