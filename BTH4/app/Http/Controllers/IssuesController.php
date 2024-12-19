<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use App\Models\Issue;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = issue::with( 'computer')->paginate(10); // Phân trang 10 bản ghi/trang
        return view('Issues.index', compact('issues'));
    }

  
   
    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'nullable|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
        issue::create($request->all());
        return redirect()->route('issues.index')->with('success','Vấn đề đã được thêm thành công!');
    }
    public function edit(string $id)
    {
        $issue = issue::findOrFail($id);
        $computers = computer::all();
        return view('issues.edit', compact('issue' ,'computers'));
    }

    public function update(Request $request, string $id){
        $validatedData = $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'nullable|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
        $issue = issue::find($id);
        $issue->update($request->all());
        return redirect()->route('issues.index')->with('success','Cập nhật vấn đề thành công!');
    }
    
    public function destroy(string $id)
    {
        $issue = issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công!');
    }
}
