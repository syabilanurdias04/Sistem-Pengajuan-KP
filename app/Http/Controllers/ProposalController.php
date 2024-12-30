<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Mahasiswa;
use App\Notifications\ProposalStatusNotification;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $query = Proposal::with('mahasiswa');

    if ($request->has('search')) {
        $query->whereHas('mahasiswa', function($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        });
    }

    $proposals = $query->paginate(10); // Menampilkan 10 proposal per halaman
    return view('proposal.index', compact('proposals'));
        
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        return view('proposal.create', compact('mahasiswas'));
    }

    public function store(Request $request)
{
    Notification::send(User::where('role', 'admin')->get(), new NewProposalNotification('Proposal baru telah diajukan.'));
    return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diajukan.');
    $this->validate($request, [
        'draft' => 'required',
        'mahasiswa_id' => 'required|exists:mahasiswas,id',
    ]);

    // Cek apakah mahasiswa memiliki pengajuan yang sedang berlangsung
    $existingProposal = Proposal::where('mahasiswa_id', $request->mahasiswa_id)
        ->where('status', 'pending')
        ->first();

    if ($existingProposal) {
        return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan yang sedang berlangsung.');
    }

    // Cek apakah saat ini dalam rentang waktu pengajuan
    $jadwal = JadwalPengajuan::first(); // Ambil jadwal pengajuan yang ada
    if (!$jadwal || now()->toDateString() < $jadwal->tanggal_mulai || now()->toDateString() > $jadwal->tanggal_selesai) {
        return redirect()->back()->with('error', 'Pengajuan hanya dapat dilakukan dalam rentang waktu yang ditentukan.');
    }

    // Simpan proposal
    Proposal::create($request->all());

    return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diajukan.');
}

    public function show(Proposal $proposal)
    {
        return view('proposal.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        if ($proposal->mahasiswa_id !== auth()->id()) {
            return redirect()->route('proposal.index')->with('error', 'Anda tidak memiliki akses untuk mengedit proposal ini.');
        }
    
        return view('proposal.edit', compact('proposal'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $this->validate($request, [
            'draft' => 'required',
        ]);

        $proposal->update($request->all());

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }

    public function accept(Proposal $proposal)
    {
        $proposal->update(['status' => 'accepted']);
        Notification::send($proposal->mahasiswa, new ProposalStatusNotification('Proposal Anda diterima.'));
        return redirect()->route('proposal.index')->with('success', 'Proposal diterima.');
    }

    public function reject(Proposal $proposal)
    {
        $proposal->update(['status' => 'rejected']);
        return redirect()->route('proposal.index')->with('success', 'Proposal ditolak.');
    }

}