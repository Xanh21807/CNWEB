<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issues;
use App\Models\Computers;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issues::with('computer')->get();
        return view('issues.index', compact('issues'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $computers = Computers::all();
        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required',
            'reported_date' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
        ]);

        Issues::create($request->all());
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm mới.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $issues = Issues::findOrFail($id);
        $computers = Computers::all();
        return view('issues.edit', compact('issues', 'computers'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required',
            'reported_date' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
        ]);
        $issues = Issues::find($id);
        $issues->update($request->all());
        return redirect()->route('issues.index')->with('success', 'Thông tin vấn đề đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $issues = Issues::findOrFail($id);
        $issues->delete();

        return redirect()->route('issues.index')->with('success', 'Đồ án đã được xóa thành công!');
    }
}
