<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computers;
use App\Models\Issues;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = issues::with( 'computer')->paginate(10); // Phân trang 10 bản ghi/trang
        return view('Issues.index', compact('issues'));
    }

  
   
    public function create()
    {
        $computers = Computers::all();
        return view('Issues.create', compact('computers'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'nullable|string|max:50',
            'reported_date' => 'required|datetime',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
        issues::create($request->all());
        return redirect()->route('Issues.index')->with('success','Vấn đề đã được thêm thành công!');
    }
    public function edit(string $id)
    {
        $issue = issues::findOrFail($id);
        $computers = computers::all();
        return view('Issues.edit', compact('issue' ,'computers'));
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
        $issue = issues::find($id);
        $issue->update($request->all());
        return redirect()->route('Issues.index')->with('success','Cập nhật vấn đề thành công!');
    }
    
    public function destroy(string $id)
    {
        $issue = issues::findOrFail($id);
        $issue->delete();

        return redirect()->route('Issues.index')->with('success', 'Vấn đề đã được xóa thành công!');
    }
}
