<div class="container">
    <h1>Dashboard Admin</h1>
    <h2>Daftar Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->id }}</td>
                <td>{{ $mahasiswa->nama }}</td>
                <td>
                    <!-- Tombol untuk edit dan delete -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Jadwal Pengajuan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalPengajuan as $jadwal)
            <tr>
                <td>{{ $jadwal->id }}</td>
                <td>{{ $jadwal->tanggal }}</td>
                <td>
                    <!-- Tombol untuk edit dan delete -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection