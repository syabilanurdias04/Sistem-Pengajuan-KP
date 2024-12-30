<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>

        <h2>Menu</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('proposal.index') }}">Daftar Proposal</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('jadwal.index') }}">Jadwal Pengajuan</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</body>
</html>