<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TermModel;
use App\Models\SessionModel;
use Auth;

class TermController extends Controller
{
    // List all terms
    public function list()
    {
        $getRecord = TermModel::with(['session', 'creator'])
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.examinations.term.list', compact('getRecord'));
    }

    // Show add term form
    public function add()
    {
        $sessions = SessionModel::where('is_delete', 0)->get();
        return view('admin.examinations.term.add', compact('sessions'));
    }

    // Insert new term
    public function insert(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:session,id',
            'name' => 'required|string|max:255',
        ]);

        TermModel::create([
            'session_id' => $request->session_id,
            'name'       => $request->name,
            'created_by' => Auth::id(),
            'is_delete'  => 0,
        ]);

        return redirect()->route('admin.term.list')->with('success', 'Term added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $term = TermModel::findOrFail($id);
        $sessions = SessionModel::where('is_delete', 0)->get();

        return view('admin.examinations.term.edit', compact('term', 'sessions'));
    }

    // Update term
    public function update(Request $request, $id)
    {
        $request->validate([
            'session_id' => 'required|exists:session,id',
            'name'       => 'required|string|max:255',
        ]);

        $term = TermModel::findOrFail($id);
        $term->update([
            'session_id' => $request->session_id,
            'name'       => $request->name,
        ]);

        return redirect()->route('admin.term.list')->with('success', 'Term updated successfully!');
    }

    // Soft delete term
    public function delete($id)
    {
        $term = TermModel::findOrFail($id);
        $term->update(['is_delete' => 1]);

        return redirect()->back()->with('success', 'Term deleted successfully!');
    }
}
