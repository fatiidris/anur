<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Request;
use App\Models\SessionModel;

class SessionController extends Controller
{
    // List all sessions (only not deleted)
    public function list()
    {
        $data['getRecord'] = SessionModel::getRecord();
        $data['sessions'] = SessionModel::where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();
        $data['header_title'] = "Session List";

        return view('admin.examinations.session.list', $data);
    }

    // Show add form
    public function add()
    {
        $data['header_title'] = "Add New Session";
        return view('admin.examinations.session.add');
    }

    // Insert new session
    public function insert(Request $request)
    {
        $session = new SessionModel();
        $session->name = $request->name;
        $session->is_delete = 0; // default to active
        $session->created_by = Auth::user()->id;
        $session->save();

        return redirect('admin/examinations/session/list')
            ->with('success', 'Session added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $data['session'] = SessionModel::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();
        $data['header_title'] = "Edit Session";
        return view('admin.examinations.session.edit', $data);
    }

    // Update session
    public function update(Request $request, $id)
    {
        $session = SessionModel::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();
        $session->name = $request->name;
        $session->created_by = Auth::user()->id;
        $session->save();

        return redirect('admin/examinations/session/list')
            ->with('success', 'Session updated successfully!');
    }

    // Soft delete session
    public function delete($id)
    {
        $session = SessionModel::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();
        $session->is_delete = 1;
        $session->save();

        return redirect('admin/examinations/session/list')
            ->with('success', 'Session deleted successfully!');
    }
}
