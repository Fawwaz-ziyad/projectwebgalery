<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="../admin/dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li><a href="../admin/kategori.php"><i class="fa fa-tags"></i> Kategori</a>
            </li>
            <li><a href="../admin/post.php"><i class="fa fa-pencil"></i> Post</a>
            </li>
            <li><a href="../admin/galeri.php"><i class="fa fa-table"></i> Galeri</a>
            </li>
            <li><a href="../admin/profile.php"><i class="fa fa-photo"></i> Profile</a>
            </li>
            <li><a href="../admin/petugas.php"><i class="fa fa-group"></i> Petugas</a>
            </li>
        </ul>
    </div>
    </ul>
</div>
<!-- /menu footer buttons -->
<div class="sidebar-footer">
    <a href="../logout.php" class="logout-btn" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        <span class="logout-text">Logout</span>
    </a>
</div>

<!-- /menu footer buttons -->
</div>
</div>

<style>
    .sidebar-footer {
        padding: 10px;
        background-color: #2A3F54;
        /* Sesuaikan warna sidebar */
        text-align: center;
    }

    .sidebar-footer .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        /* Lebar penuh sesuai sidebar */
        padding: 10px 0;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
        border-radius: 0;
        /* Hilangkan border radius */
    }

    .sidebar-footer .logout-btn:hover {
        background-color: #1a2738;
        /* Warna hover */
        color: #ff4d4d;
    }

    .sidebar-footer .logout-btn .glyphicon {
        margin-right: 8px;
        /* Jarak ikon dengan teks */
        font-size: 16px;
    }

    .logout-text {
        display: inline-block;
    }
</style>