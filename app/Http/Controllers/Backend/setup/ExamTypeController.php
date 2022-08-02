<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{

    public function ViewExamType()
    {

        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }


    public function ExamTypeAdd()
    {
        return view('backend.setup.exam_type.add_exam_type');
    }


    public function ExamTypeStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:exam_types|max:255',
            ],
            [
                'name.unique:exam_types' => 'Name already taken.'
            ]
        );

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Exam type added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('exam.type.view')->with($notification);
    }


    public function ExamTypeEdit($id)
    {
        $editData = ExamType::find($id);

        return view('backend.setup.exam_type.edit_exam_type', compact('editData'));
    }

    public function ExamTypeUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:exam_types|max:255',
            ],
            [
                'name.unique:exam_types' => 'Exam type already taken.'
            ]
        );

        $data = ExamType::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Exam type updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('exam.type.view')->with($notification);
    }

    public function ExamTypeDelete($id)
    {
        $data = ExamType::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Exam type deleted successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
