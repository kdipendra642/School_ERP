<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;


class AssignSubjectController extends Controller
{
    public function ViewAssignSubject()
    {
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();

        // $data['allData'] = AssignSubject::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    public function AssignSubjectAdd(Request $request)
    {
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }

    public function AssignSubjectStore(Request $request)
    {
        $subjectcount = count($request->subject_id);

        if ($subjectcount != NULL) {
            for ($i = 0; $i < $subjectcount; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];

                $assign_subject->save();
            }
        }

        $notification = array(
            'message' => 'Subject Assigned successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('assign.subject.view')->with($notification);
    }

    public function AssignSubjectEdit(Request $request, $class_id)
    {
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderby('subject_id', 'ASC')->get();

        // dd($data['editData']->toArray());
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    public function AssignSubjectUpdate(Request $request, $class_id)
    {
        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Sorry you did not select any subject.',
                'alert-type' => 'error',
            );

            return redirect()->route('fee.amount.edit', $class_id)->with($notification);
        } else {

            $subjectCount = count($request->subject_id);

            AssignSubject::where('class_id', $class_id)->delete();

            if ($subjectCount != NULL) {
                for ($i = 0; $i < $subjectCount; $i++) {
                    $assign_subject = new AssignSubject();
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->pass_mark = $request->pass_mark[$i];
                    $assign_subject->subjective_mark = $request->subjective_mark[$i];

                    $assign_subject->save();
                }
            }

            $notification = array(
                'message' => 'Subject assign updated successfully.',
                'alert-type' => 'success',
            );

            return redirect()->route('assign.subject.view')->with($notification);
        }
    }

    public function AssignSubjectDetails(Request $request, $class_id)
    {
        $data['detailData'] = AssignSubject::where('class_id', $class_id)->orderby('subject_id', 'ASC')->get();

        return view('backend.setup.assign_subject.detail_assign_subject', $data);
    }
}
