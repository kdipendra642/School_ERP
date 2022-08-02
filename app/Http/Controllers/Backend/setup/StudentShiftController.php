<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewShift()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
    }

    public function StudentShiftAdd()
    {
        return view('backend.setup.shift.add_shift');
    }

    public function StudentShiftStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_shifts|max:255',
            ],
            [
                'name.unique:student_shifts' => 'Year already taken.'
            ]
        );

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Student shift added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function StudentShiftEdit($id)
    {
        $editData = StudentShift::find($id);

        return view('backend.setup.shift.edit_shift', compact('editData'));
    }

    public function StudentShiftUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_shifts|max:255',
            ],
            [
                'name.unique:student_shifts' => 'Shift already taken.'
            ]
        );

        $data = StudentShift::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Student shift updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function StudentShiftDelete($id)
    {
        $data = StudentShift::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Shift deleted successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
