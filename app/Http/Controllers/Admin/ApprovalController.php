<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Menampilkan semua materi yang statusnya 'pending'.
     */
    public function index()
    {
        $pendingMaterials = Material::with('user', 'track')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.approvals.index', compact('pendingMaterials'));
    }

    /**
     * Menyetujui materi.
     */
    public function approve(Material $material)
    {
        $material->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Materi telah disetujui.');
    }

    /**
     * Menolak materi.
     */
    public function reject(Material $material)
    {
        $material->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Materi telah ditolak.');
    }
}
