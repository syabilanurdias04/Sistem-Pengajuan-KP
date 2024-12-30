@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pengaturan Aplikasi</h1>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Notifikasi</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <!-- Tambahkan input lain sesuai kebutuhan -->
        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>
@endsection