<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poly;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request){
        $schedules = Schedule::search($request->search)->paginate(10);
        $doctors = User::whereRole('doctor')->get();
        $polies = Poly::all();
        return view('admin.schedule.index', compact('schedules', 'doctors', 'polies'));
    }

    public function store(Request $request){
        $this->_validation($request);
        Schedule::create($request->only('user_id', 'poly_id', 'day', 'start', 'finish'));
        return back()->with('success', 'Data created successfully');
    }

    public function update(Request $request, Schedule $schedule){
        $request['id'] = $schedule->id;
        $this->_validation($request);
        $schedule->update($request->only('user_id', 'poly_id', 'day', 'start', 'finish'));
        return back()->with('success', 'Data updated successfully');
    }

    public function destroy(Schedule $schedule){
        $schedule->delete();
        return back()->with('success', 'Data removed');
    }

    private function _validation(Request $request){
        return $request->validate([
            'day' => 'required|max:50',
            'start' => 'required|max:50',
            'finish' => 'required|max:50',
        ]);
    }
}
