<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Proposal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajukan Proposal Baru</h1>

        <form action="{{ route('proposal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mahasiswa_id">Mahasiswa</label>
                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="draft">Draft Proposal</label>
                <textarea name="draft" id="draft" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Proposal</button>
            <a href="{{ route('proposal.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>