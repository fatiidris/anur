<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignSubjectTeacherModel;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Support\Facades\Auth;

class AssignSubjectTeacherController extends Controller
{
    /**
     * Display a listing of assignments.
     */
    public function list(Request $request)
    {
        $data['getRecord'] = AssignSubjectTeacherModel::getRecord();
        $data['header_title'] = "Assign Subject Teacher";

        return view('admin.assign_subject_teacher.list', $data);
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function add()
    {
        $data['getTeacher'] = User::getTeacher();
        $data['getClass']   = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();

        return view('admin.assign_subject_teacher.add', $data);
    }

    /**
     * Store a newly created assignment (multiple subjects & teachers allowed).
     */
    public function insert(Request $request)
    {
        // ✅ Validate request
        $request->validate([
            'class_id'      => 'required|integer|exists:class,id',
            'subject_id'    => 'required|array',
            'subject_id.*'  => 'integer|exists:subject,id',
            'teacher_id'    => 'required|array',
            'teacher_id.*'  => 'integer|exists:users,id',
            'status'        => 'nullable|integer|in:0,1',
        ]);

        $subjects = $request->input('subject_id', []);   // default to []
        $teachers = $request->input('teacher_id', []);

        $status = $request->status ?? 0;

        foreach ($request->subject_id as $subject_id) {
            foreach ($request->teacher_id as $teacher_id) {
                $existing = AssignSubjectTeacherModel::where('class_id', $request->class_id)
                    ->where('subject_id', $subject_id)
                    ->where('teacher_id', $teacher_id)
                    ->first();

                if ($existing) {
                    $existing->status    = $status;
                    $existing->is_delete = 0;
                    $existing->save();
                } else {
                    AssignSubjectTeacherModel::create([
                        'class_id'   => $request->class_id,
                        'subject_id' => $subject_id,
                        'teacher_id' => $teacher_id,
                        'status'     => $status,
                        'created_by' => Auth::id(),
                        'is_delete'  => 0,
                    ]);
                }
            }
        }

        return redirect('admin/assign_subject_teacher/list')
            ->with('success', 'Subjects assigned to teacher(s) successfully!');
    }

    /**
     * Show the form for editing the specified assignment.
     */
   public function edit($id)
{
    // Get the single assignment record
    $getRecord = AssignSubjectTeacherModel::getSingle($id);
    if (!$getRecord) {
        abort(404);
    }

    $data['getRecord'] = $getRecord;

    // ✅ Get subjects assigned to this class (for checkboxes)
    $data['getAssignSubjectID'] = AssignSubjectTeacherModel::getAssignSubjectID(
        $getRecord->class_id
    );

    // ✅ Get teachers assigned to this class/subject
    $data['getAssignTeacherID'] = AssignSubjectTeacherModel::getAssignTeacherID(
        $getRecord->class_id,
        $getRecord->subject_id
    );

    // Dropdown / checkbox data
    $data['getClass']   = ClassModel::getClass();
    $data['getSubject'] = SubjectModel::getSubject();
    $data['getTeacher'] = User::getTeacher();
    $data['header_title'] = "Edit Subject–Teacher Assignment";

    return view('admin.assign_subject_teacher.edit', $data);
}

    /**
     * Update the specified assignment.
     */
    public function update(Request $request)
    {
        $request->validate([
            'class_id'      => 'required|integer|exists:class,id',
            'subject_id'    => 'required|array',
            'subject_id.*'  => 'integer|exists:subject,id',
            'teacher_id'    => 'required|array',
            'teacher_id.*'  => 'integer|exists:users,id',
            'status'        => 'nullable|integer|in:0,1',
        ]);

        $status = $request->status ?? 0;

        foreach ($request->subject_id as $subject_id) {
            // Remove all current teachers for this class/subject
            AssignSubjectTeacherModel::deleteTeacher($request->class_id, $subject_id);

            foreach ($request->teacher_id as $teacher_id) {
                $existing = AssignSubjectTeacherModel::getAlreadyFirst(
                    $request->class_id,
                    $subject_id,
                    $teacher_id
                );

                if ($existing) {
                    $existing->status    = $status;
                    $existing->is_delete = 0;
                    $existing->save();
                } else {
                    AssignSubjectTeacherModel::create([
                        'class_id'   => $request->class_id,
                        'subject_id' => $subject_id,
                        'teacher_id' => $teacher_id,
                        'status'     => $status,
                        'created_by' => Auth::id(),
                        'is_delete'  => 0,
                    ]);
                }
            }
        }

        return redirect('admin/assign_subject_teacher/list')
            ->with('success', 'Subject–Teacher assignment updated successfully!');
    }

    /**
     * Soft-delete the specified assignment.
     */
    public function delete($id)
    {
        $record = AssignSubjectTeacherModel::findOrFail($id);
        $record->is_delete = 1;
        $record->save();

        return redirect('admin/assign_subject_teacher/list')
            ->with('success', 'Assignment deleted successfully!');
    }
}
