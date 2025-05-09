<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = $request->roles ? [$request->roles] : ['admin', 'doctor', 'pharmacist', 'patient'];
        $users = User::search($request->search)->whereIn('role', $roles)->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Debugging: Cek apakah request masuk
        // dd($request->all());

        // Validasi input
        $this->_validation($request);

        // Buat email otomatis jika tidak diisi
        if (!$request->filled('email')) {
            $birthDateFormatted = Carbon::parse($request->birth_date)->format('Ymd');
            $request['email'] = $birthDateFormatted . '@example.com';
        }

        // Set nomor rekam medis jika role adalah patient
        $request['rm'] = $request->role == 'patient' ? setRm() : null;

        // Simpan user dengan hashing password
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'blood_type' => $request->blood_type,
            'rm' => $request->rm,
            'role' => $request->role,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User berhasil didaftarkan.');
    }

    public function update(Request $request, User $user)
    {
        $this->_validation($request, true);

        $data = $request->only('name', 'email', 'phone', 'id_number', 'role', 'address', 'birth_date');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    private function _validation(Request $request, $isUpdate = false)
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'nullable|email|max:100|unique:users,email' . ($isUpdate ? ',' . $request->id : ''),
            'birth_date' => 'required|date',
            'phone' => 'required|max:50',
            'blood_type' => 'required|in:A,B,AB,O',
            'role' => 'required|max:50',
            'address' => 'required|max:255',
            'password' => $isUpdate ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
        ];

        return $request->validate($rules);
    }
}
