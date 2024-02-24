<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/app.scss'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>@yield('title')</title>
</head>




<body id="body-pd">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="/dashboard/" class="nav_logo"> <i class='bi bi-buildings nav_logo-icon'></i>
                    <span class="nav_logo-name">LIST BARANG</span> </a>
                <div class="nav_list">
                    <a href="/barang/" class="nav_link {{ Request::is('barang*') ? 'active' : '' }}"> <i class="bi bi-grid-fill"></i><span
                        class="nav_name">Barang</span> </a>
                    
                    <a href="/jual/" class="nav_link {{ Request::is('jual*') ? 'active' : '' }}"> <i class="bi bi-grid-fill"></i><span
                            class="nav_name">Jual</span> </a>

                    <a href="/beli/" class="nav_link {{ Request::is('beli*') ? 'active' : '' }}"> <i class="bi bi-database"></i><span
                            class="nav_name">Beli</span> </a>

                    <a href="/stok/" class="nav_link {{ Request::is('stok*') ? 'active' : '' }}"> <i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Stok</span> </a>

                    <a href="/logs/" class="nav_link {{ Request::is('logs*') ? 'active' : '' }}"> <i class='bx bx-message-square-detail nav_icon'></i> <span
                            class="nav_name">Logs</span></a>

                </div>
            </div>
            <a href="/login" class="nav_link"> <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">Log out</span> </a>
        </nav>
    </div>
    <div class="container-main">
        @yield('content')
    </div>
</body>
<footer>
    @yield('footer')
</footer>
