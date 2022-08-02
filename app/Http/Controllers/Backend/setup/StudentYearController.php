<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class StudentYearController extends Controller
{
    public function ViewYear()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    public function StudentYearAdd()
    {
        return view('backend.setup.year.add_year');
    }

    public function StudentYearStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_years|max:255',
            ],
            [
                'name.unique:student_years' => 'Year already taken.'
            ]
        );

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Year added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function StudentYearEdit($id)
    {
        $editData = StudentYear::find($id);

        return view('backend.setup.year.edit_year', compact('editData'));
    }

    public function StudentYearUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:student_years|max:255',
            ],
            [
                'name.unique:student_years' => 'Year already taken.'
            ]
        );

        $data = StudentYear::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Class updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    public function StudentYearDelete($id)
    {
        $data = StudentYear::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Year updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
