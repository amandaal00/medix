<?php

namespace App\Http\Controllers;

use App\Models\MedicalAccessRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalAccessController extends Controller
{
    // Dokter mengajukan permintaan akses
    public function requestAccess($patientId)
    {
        $doctorId = Auth::id();

        // Cek apakah sudah ada permintaan sebelumnya
        $existingRequest = MedicalAccessRequest::where('doctor_id', $doctorId)
            ->where('patient_id', $patientId)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Permintaan akses sudah diajukan, menunggu persetujuan pasien.'
            ], 400);
        }

        // Buat permintaan baru
        MedicalAccessRequest::create([
            'doctor_id' => $doctorId,
            'patient_id' => $patientId,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan akses telah diajukan.'
        ]);
    }

    // Pasien menyetujui atau menolak permintaan akses
    public function respondAccess(Request $request, $requestId)
    {
        $accessRequest = MedicalAccessRequest::findOrFail($requestId);

        // Pastikan hanya pasien yang bisa merespon permintaan
        if ($accessRequest->patient_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Jika disetujui, atur masa berlaku (misalnya 1 jam)
        $expiresAt = $request->status === 'approved' ? now()->addMinutes(2) : null;

        // Update status dan waktu kadaluarsa
        $accessRequest->update([
            'status' => $request->status,
            'expires_at' => $expiresAt
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan akses telah ' . ($request->status === 'approved' ? 'disetujui' : 'ditolak') . '.'
        ]);
    }
}
