<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\JadwalPengajuan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $jadwalPengajuan = JadwalPengajuan::all();
        return view('admin.index', compact('mahasiswas', 'jadwalPengajuan'));
    }

    public function createMahasiswa(Request $request)
    {
        // Validasi dan simpan mahasiswa baru
    }

    public function createJadwal(Request $request)
    {
        // Validasi dan simpan jadwal pengajuan baru
    }

    // Metode lain untuk edit, update, delete
}

