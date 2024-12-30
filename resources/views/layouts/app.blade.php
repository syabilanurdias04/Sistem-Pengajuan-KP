@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Proposal</h1>
        <a href="{{ route('proposal.create') }}" class="btn btn-primary">Buat Proposal Baru</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                <tr>
                    <td>{{ $proposal->id }}</td>
                    <td>{{ $proposal->mahasiswa->nama }}</td>
                    <td>{{ $proposal->status }}</td>
                    <td>
                        <a href="{{ route('proposal.edit', $proposal) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('proposal.destroy', $proposal) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <form action="{{ route('proposal.accept', $proposal) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Terima</button>
                        </form>
                        <form action="{{ route('proposal.reject', $proposal) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection