<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $total_doctor = User::whereRole('doctor')->count();
        $total_pharmacist = User::whereRole('pharmacist')->count();
        $total_patient = User::whereRole('patient')->count();
        $total_checkup = Checkup::count();
        
        return view('admin.dashboard.index', compact('total_doctor', 'total_pharmacist', 'total_patient', 'total_checkup'));
    } 
}
