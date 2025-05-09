<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleCollection;
use App\Models\Checkup;
use App\Models\Detail;
use App\Models\Medicine;
use App\Models\Poly;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRequest;
use App\Models\MedicalAccessRequest;


class AppointmentController extends Controller
{
    public function index(Request $request){
        $polies = Poly::all();
        $schedules = Schedule::whereStatus(true)->get();
        $statuses = $request->statuses ? [$request->statuses] : ['checkup', 'waiting_medicine', 'done', 'canceled'];
        $checkups = Checkup::where('user_id', auth()->id())
            ->whereIn('status', $statuses)
            ->paginate(10);
        $medicalRequests = MedicalAccessRequest::where('patient_id', auth()->id())->get();
        return view('site.appointment', compact('polies', 'schedules', 'checkups', 'medicalRequests'));
    }

    public function schedules($poly_id){ //api
        $schedules = Schedule::wherePolyId($poly_id)->whereStatus(true)->get();
        return response()->json(new ScheduleCollection($schedules), 200);
    }

    public function store(Request $request){
        $request->validate([
            'complaint' => 'required|max:255',
            'schedule' => 'required|numeric',
        ]);
        $request['user_id'] = Auth::user()->id;
        $request['schedule_id'] = $request->schedule;
        Checkup::create($request->only('complaint', 'user_id', 'schedule_id'));
        return back()->with('success', 'Berhasil mendaftar poli');
    }

    public function checkup(Checkup $checkup){
        if(Auth::user()->role == 'patient' && $checkup->user_id != Auth::user()->id) return abort(403);
        if(Auth::user()->role == 'doctor' && $checkup->schedule->user->id != Auth::user()->id) return abort(403);
        $medicines = Medicine::all();
        return view('site.checkup', compact('checkup', 'medicines'));
    }

    public function update(Request $request, Checkup $checkup){
        $checkup_price = 150000;
        $total_price = $checkup_price;
        foreach ($request->medicine_id as $key => $medicine_id) {
            $medicine = Medicine::find($medicine_id);
            Detail::create([
                'checkup_id' => $checkup->id, 'medicine_id' => $medicine_id, 'application' => $request->application[$key],
                'qty' => $request->qty[$key], 'price' => $medicine->price
            ]);
            $total_price += ($medicine->price * $request->qty[$key]);
        }
        $checkup->update([
            'note' => $request->note, 'checkup_price' => $checkup_price, 'total_price' => $total_price, 'status' => 'waiting_medicine'
        ]);
        return redirect('/workspace')->with('success', 'Data Recorded.');
    }

    public function update_status(Request $request, Checkup $checkup){
        $checkup->update($request->only('status'));
        return back();
    }


}
