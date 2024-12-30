<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPengajuan; // Make sure to import your model

class JadwalPengajuanController extends Controller
{
    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Create a new JadwalPengajuan record
        JadwalPengajuan::create($request->all());

        // Redirect with success message
        return redirect()->route('jadwal.index')->with('success', 'Jadwal pengajuan berhasil dibuat.');
    }

    public function edit(JadwalPengajuan $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPengajuan $jadwal)
    {
        // Validate the request
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Update the JadwalPengajuan record
        $jadwal->update($request->all());

        // Redirect with success message
        return redirect()->route('jadwal.index')->with('success', 'Jadwal pengajuan berhasil diperbarui.');
    }
}