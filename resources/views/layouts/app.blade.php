<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kelompok Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Kelompokin</a>

        <div class="navbar-nav">
            <a class="nav-link text-white" href="/">Dashboard</a>
            <a class="nav-link text-white" href="/siswa">Daftar Siswa</a>
            <a class="nav-link text-white" href="/kelompok">Generate Kelompok</a>
            <a class="nav-link text-white" href="/kelompok/riwayat">Riwayat</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

</body>
</html>