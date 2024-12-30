<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        return Proposal::with('mahasiswa')->get();
    }

    public function show(Proposal $proposal)
    {
        return $proposal;
    }

    public function store(Request $request)
    {
        // Validasi dan simpan proposal
        // ...
    }

    public function update(Request $request, Proposal $proposal)
    {
        // Validasi dan update proposal
        // ...
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return response()->noContent();
    }
}
