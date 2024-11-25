<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Sidebar</title>
    <!-- Tambahkan link ke FontAwesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling Sidebar */
        .custom-sidebar {
            background-color: #ffffff; /* Background putih */
            box-shadow: 0 4px 5px rgba(0, 0, 0, 0); /* Bayangan halus */
            border-radius: 0 30px 30px 0; /* Membuat pojok kanan sidebar melengkung */
            padding-top: 20px; /* Jarak atas */
            width: 250px; /* Lebar sidebar */
            border: 3px solid rgba(106, 103, 103, 0.2);
        }

        .custom-sidebar-brand {
            padding: 10px 0;
        }

        .custom-sidebar-brand-icon img {
            width: 180px;
            margin: 0 auto;
        }

        .custom-sidebar-divider {
            border-top: 1px solid rgba(0, 0, 139, 0.5); /* Warna garis yang lebih lembut */
        }

        .custom-nav-item {
            padding: 10px 15px;
        }

        .custom-nav-link {
            display: flex;
            align-items: center;
            padding: 10px;
            font-size: 14px;
            color: #333; /* Warna teks utama */
            text-decoration: none;
        }

        .custom-nav-link i {
            font-size: 20px;
            color: #003b6d; /* Warna ikon biru tua */
            margin-right: 10px;
        }

        .custom-nav-link span {
            color: #003b6d; /* Warna teks biru tua */
        }

        .custom-nav-link:hover {
            background-color: rgba(0, 59, 109, 0.1); /* Warna latar saat hover */
            border-radius: 5px;
        }

        .custom-nav-item.active .custom-nav-link {
            background-color: rgba(0, 59, 109, 0.1); /* Background aktif */
            border-radius: 5px;
        }

        hr.custom-sidebar-divider {
            border: 1px solid rgba(0, 0, 139, 0.5); /* Warna garis yang lebih lembut */
            width: 100%;
            margin: -0.3rem auto 0.5rem;
        }


        /* Divider */
        .sidebar-divider {
            border-top: 1px solid #dee2e6;
            margin: 1rem 0;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <ul class="navbar-nav custom-sidebar sidebar accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="custom-sidebar-brand d-flex flex-column align-items-center justify-content-center" href="{{ url('/dashboard') }}">
            <div class="custom-sidebar-brand-icon mb-2">
                <img src="{{ asset('sb-admin-2/img/login/kanitra2.png') }}" alt="Logo Kanitra" style="width: 160px; height: auto; margin-top: -22px;">
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Garis horizontal yang lebih jelas -->
        <hr style="border: 1px solid rgba(0, 0, 139, 0.5); width: 100%;  margin: -0.3rem auto 0.5rem; ">

        <!-- Nav Item - Dashboard -->
        <li class="custom-nav-item active">
            <a class="custom-nav-link" href="{{ url('/dashboard') }}">
                <img src="{{ asset('sb-admin-2/img/login/dasbor.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - Transaksi -->
        <li class="custom-nav-item">
            <a class="custom-nav-link" href="{{ url('/transaksi') }}">
                <img src="{{ asset('sb-admin-2/img/login/transaksi.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Transaksi</span>
            </a>
        </li>

        <!-- Nav Item - Simpanan -->
        <li class="custom-nav-item">
            <a class="custom-nav-link" href="{{ url('/simpanan') }}">
                <img src="{{ asset('sb-admin-2/img/login/simpanan.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Simpanan</span>
            </a>
        </li>

        <!-- Nav Item - Pinjaman -->
        <li class="custom-nav-item">
            <a class="custom-nav-link" href="{{ url('/pinjaman') }}">
                <img src="{{ asset('sb-admin-2/img/login/pinjaman.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Pinjaman</span>
            </a>
        </li>
    

        <!-- Nav Item - Pengajuan Pinjaman -->
        <li class="custom-nav-item">
            <a class="custom-nav-link" href="{{ url('/pengajuan') }}">
                <img src="{{ asset('sb-admin-2/img/login/pinjaman.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Pengajuan Pinjaman</span>
            </a>
        </li>


        <!-- Nav Item - Tabungan Qurban -->
        <li class="custom-nav-item">
            <a class="custom-nav-link" href="{{ url('/tabungan-qurban') }}">
                <img src="{{ asset('sb-admin-2/img/login/tabungan.png') }}" alt="Dashboard Icon" style="height: 20px; width: 20px; margin-right: 8px;">
                <span>Tabungan Qurban</span>
            </a>
        </li>

    </ul>

</body>
</html>
