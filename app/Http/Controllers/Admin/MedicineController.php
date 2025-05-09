<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request){
        $medicines = Medicine::search($request->search)->paginate(10);
        return view('admin.medicine.index', compact('medicines'));
    }

    public function store(Request $request){
        $this->_validation($request);
        Medicine::create($request->only('name', 'unit', 'price'));
        return back()->with('success', 'Data created successfully');
    }

    public function update(Request $request, Medicine $medicine){
        $request['id'] = $medicine->id;
        $this->_validation($request);
        $medicine->update($request->only('name', 'unit', 'price'));
        return back()->with('success', 'Data updated successfully');
    }

    public function destroy(Medicine $medicine){
        $medicine->delete();
        return back()->with('success', 'Data removed');
    }

    private function _validation(Request $request){
        return $request->validate([
            'name' => 'required|max:50',
            'unit' => 'required|max:50',
            'price' => 'required|numeric',
        ]);
    }
}
