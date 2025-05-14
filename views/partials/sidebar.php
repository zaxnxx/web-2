<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Manajemen Anggota -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="collapseAnggota">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Manajemen Anggota
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAnggota" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="views/pegawai/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Pegawai
                        </a>
                        <a class="nav-link" href="views/anggota/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                            Anggota
                        </a>
                    </nav>
                </div>

                <!-- Manajemen Produk -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk" aria-expanded="false" aria-controls="collapseProduk">
                    <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                    Manajemen Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="views/jenis_produk/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Jenis Produk
                        </a>
                        <a class="nav-link" href="views/kartu_diskon/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-percentage"></i></div>
                            Kartu Diskon
                        </a>
                        <a class="nav-link" href="views/daftar_produk/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Daftar Produk
                        </a>
                    </nav>
                </div>

                <!-- Manajemen Pemesanan -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePemesanan" aria-expanded="false" aria-controls="collapsePemesanan">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Manajemen Pemesanan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePemesanan" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="views/pemesanan/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Pesanan
                        </a>
                        <a class="nav-link" href="views/pembayaran/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Pembayaran
                        </a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Haidar Rozan
        </div>
    </nav>
</div>
