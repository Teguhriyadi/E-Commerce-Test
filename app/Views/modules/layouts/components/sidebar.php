<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('modules/dashboard') ?>">
                Admin Panel
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= str_starts_with(uri_string(), 'modules/dashboard') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('modules/dashboard') ?>">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Menu</li>
            <li class="<?= str_starts_with(uri_string(), 'modules/promo') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('modules/promo') ?>">
                    <i class="fa fa-bars"></i>
                    <span>Master Promo</span>
                </a>
            </li>
            <li class="<?= str_starts_with(uri_string(), 'modules/barang') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('modules/barang') ?>">
                    <i class="fa fa-book"></i>
                    <span>Master Barang</span>
                </a>
            </li>
        </ul>
    </aside>
</div>