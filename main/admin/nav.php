<nav id="nav" class="navbar navbar-expand-lg no-print">
    <div class="container-fluid">
        <div class="navbar-brand">
            <span class="">Mesin Kasir</span>
            <span class="brand-primary">Zid</span><span class="brand-secondary">Mart</span>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">DashBoard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="laporan_penjualan.php">Laporan Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="barang.php">Barang</a>
                </li>
                <li class="nav-item">
                    <form action="../../index.php" method="post" class="nav-link">
                        <label for="logout" class="input-button danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            <span>&nbsp;Logout</span>
                            <input type="submit" name="logout" id="logout" value="logout">
                        </label>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>