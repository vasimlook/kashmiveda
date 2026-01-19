<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em
                    class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="<?= base_url('assets/images/logo.png') ?>" srcset="<?= base_url('assets/images/logo2x.png') ?> 2x" alt="logo">
                <img class="logo-dark logo-img" src="<?= base_url('assets/images/logo-dark.png') ?>" srcset="<?= base_url('assets/images/logo-dark2x.png') ?> 2x"
                    alt="logo-dark">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="<?= url_to('user_dashboard') ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?= url_to('user_my_team') ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">My Team</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?= url_to('user_bank_detail') ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                            <span class="nk-menu-text">Bank Details</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?= url_to('user_change_password') ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-lock"></em></span>
                            <span class="nk-menu-text">Change Password</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>