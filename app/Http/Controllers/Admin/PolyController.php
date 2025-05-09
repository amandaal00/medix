<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poly;
use Illuminate\Http\Request;

class PolyController extends Controller
{
    public function index(Request $request){
        $polies = Poly::search($request->search)->paginate(10);
        return view('admin.poly.index', compact('polies'));
    }

    public function store(Request $request){
        $this->_validation($request);
        Poly::create($request->only('name', 'description'));
        return back()->with('success', 'Data created successfully');
    }

    public function update(Request $request, Poly $poly){
        $request['id'] = $poly->id;
        $this->_validation($request);
        $poly->update($request->only('name', 'description'));
        return back()->with('success', 'Data updated successfully');
    }

    public function destroy(Poly $poly){
        $poly->delete();
        return back()->with('success', 'Data removed');
    }

    private function _validation(Request $request){
        return $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
        ]);
    }
}
