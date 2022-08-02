<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    }

    public function StudentGroupAdd()
    {
        return view('backend.setup.group.add_group');
    }

    public function StudentGroupStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_groups|max:255',
            ],
            [
                'name.unique:student_groups' => 'Group name already taken.'
            ]
        );

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Group added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupEdit($id)
    {
        $editData = StudentGroup::find($id);

        return view('backend.setup.group.edit_group', compact('editData'));
    }

    public function StudentGroupUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_groups|max:255',
            ],
            [
                'name.unique:student_groups' => 'Year already taken.'
            ]
        );

        $data = StudentGroup::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Group updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupDelete($id)
    {
        $data = StudentGroup::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Group updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
