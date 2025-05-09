<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkup;

class CheckupController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        return response()->json(['message' => 'CheckupController is working']);
    }

    /**
     * Menyimpan janji temu baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'complaint' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        // Simpan data ke database
        Checkup::create([
            'complaint' => $request->complaint,
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'status' => 'checkup', // Set status default
            'checkup_price' => 0, // Default price
            'total_price' => 0, // Default price
        ]);

        return redirect()->back()->with('success', 'Janji temu berhasil dibuat.');
    }

    /**
     * Memperbarui diagnosis dan catatan pemeriksaan
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'diagnosis' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $checkup = Checkup::findOrFail($id);
        $checkup->diagnosis = $request->diagnosis;
        $checkup->note = $request->note;
        $checkup->save();

        return redirect()->back()->with('success', 'Diagnosis dan catatan berhasil diperbarui.');
    }
}
