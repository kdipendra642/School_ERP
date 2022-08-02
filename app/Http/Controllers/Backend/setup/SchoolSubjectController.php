<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject()
    {

        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }


    public function SchoolSubjectAdd()
    {
        return view('backend.setup.school_subject.add_school_subject');
    }


    public function SchoolSubjectStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:school_subjects|max:255',
            ],
            [
                'name.unique:school_subjects' => 'Name already taken.'
            ]
        );

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Subject added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('school.subject.view')->with($notification);
    }


    public function SchoolSubjectEdit($id)
    {
        $editData = SchoolSubject::find($id);

        return view('backend.setup.school_subject.edit_school_subject', compact('editData'));
    }

    public function SchoolSubjectUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:school_subjects|max:255',
            ],
            [
                'name.unique:school_subjects' => 'Name already taken.'
            ]
        );

        $data = SchoolSubject::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Subject updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    public function SchoolSubjectDelete($id)
    {
        $data = SchoolSubject::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Subject deleted successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
