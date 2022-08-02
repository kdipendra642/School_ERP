<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewStudent()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    public function StudentClassAdd()
    {
        return view('backend.setup.student_class.add_class');
    }

    public function StudentClassStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes|max:255',
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function StudentClassEdit($id)
    {
        $editData = StudentClass::find($id);

        return view('backend.setup.student_class.edit_class', compact('editData'));
    }

    public function StudentClassUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes|max:255',
        ]);

        $data = StudentClass::find($id);
        $data->name = $request->name;
        $data->update();

        $notification = array(
            'message' => 'Class updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function StudentClassDelete($id)
    {
        $data = StudentClass::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Class updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
