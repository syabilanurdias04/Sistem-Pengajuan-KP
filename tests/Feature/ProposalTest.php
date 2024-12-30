<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\Proposal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProposalTest extends TestCase
{
    use RefreshDatabase;

    public function testMahasiswaDapatMengajukanProposal()
    {
        $mahasiswa = Mahasiswa::factory()->create();
        
        $response = $this->actingAs($mahasiswa)->post('/proposal', [
            'draft' => 'Draft Proposal KP',
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        $response->assertRedirect('/proposal');
        $this->assertDatabaseHas('proposals', [
            'draft' => 'Draft Proposal KP',
            'mahasiswa_id' => $mahasiswa->id,
        ]);
    }

    public function testMahasiswaTidakDapatMengajukanProposalJikaAdaYangSedangBerlangsung()
    {
        $mahasiswa = Mahasiswa::factory()->create();
        Proposal::create(['draft' => 'Draft Proposal KP', 'mahasiswa_id' => $mahasiswa->id, 'status' => 'pending']);

        $response = $this->actingAs($mahasiswa)->post('/proposal', [
            'draft' => 'Draft Proposal Baru',
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        $response->assertSessionHas('error', 'Anda sudah memiliki pengajuan yang sedang berlangsung.');
    }
}
