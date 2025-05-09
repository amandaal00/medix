<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalAccessRequest as MedicalRequest;
use App\Models\User;
use App\Events\MedicalRequestUpdated; // Untuk notifikasi real-time

class MedicalRequestController extends Controller
{
    // Menampilkan permintaan akses rekam medis di halaman pasien
    public function index()
    {
        $medicalRequests = MedicalRequest::where('patient_id', auth()->id())->get();

        return view('dashboard', compact('medicalRequests'));
    }

    // Dokter mengirim permintaan akses rekam medis
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
        ]);

        // Cek apakah sudah ada permintaan yang pending
        $existingRequest = MedicalRequest::where('doctor_id', auth()->id())
            ->where('patient_id', $request->patient_id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'Permintaan sudah dikirim, menunggu persetujuan pasien.');
        }

        // Simpan permintaan baru
        $medicalRequest = MedicalRequest::create([
            'doctor_id' => auth()->id(),
            'patient_id' => $request->patient_id,
            'status' => 'pending',
        ]);

        // Kirim notifikasi real-time ke pasien
        event(new MedicalRequestUpdated($medicalRequest));

        return back()->with('success', 'Permintaan akses rekam medis telah dikirim.');
    }

    // Pasien menyetujui permintaan akses rekam medis
    public function approve($id)
    {
        $medicalRequest = MedicalRequest::where('id', $id)
            ->where('patient_id', auth()->id())
            ->firstOrFail();

        $medicalRequest->update(['status' => 'approved']);

        // Kirim notifikasi real-time ke dokter
        event(new MedicalRequestUpdated($medicalRequest));

        return response()->json([
            'success' => true,
            'message' => 'Permintaan telah disetujui.',
            'status' => 'approved'
        ]);
    }

    // Pasien menolak permintaan akses rekam medis
    public function reject($id)
    {
        $medicalRequest = MedicalRequest::where('id', $id)
            ->where('patient_id', auth()->id())
            ->firstOrFail();

        $medicalRequest->update(['status' => 'rejected']);

        // Kirim notifikasi real-time ke dokter
        event(new MedicalRequestUpdated($medicalRequest));

        return response()->json([
            'success' => true,
            'message' => 'Permintaan telah ditolak.',
            'status' => 'rejected'
        ]);
    }
}