<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalPengajuanController extends Controller
{
    // app/Http/Controllers/JadwalPengajuanController.php
public function create()
{
    return view('jadwal.create');
}

public function store(Request $request)
{
    $this->validate($request, [
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    JadwalPengajuan::create($request->all());

    return redirect()->route('jadwal.index')->with('success', 'Jadwal pengajuan berhasil dibuat.');
}

public function edit(JadwalPengajuan $jadwal)
{
    return view('jadwal.edit', compact('jadwal'));
}

public function update(Request $request, JadwalPengajuan $jadwal)
{
    $this->validate($request, [
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $jadwal->update($request->all());

    return redirect()->route('jadwal.index')->with('success', 'Jadwal pengajuan berhasil diperbarui.');
}
}
