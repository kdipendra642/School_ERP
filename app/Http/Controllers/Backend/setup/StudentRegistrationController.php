<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;


class StudentRegistrationController extends Controller
{
    public function StudentListView()
    {
        $data['students'] = User::where('usertype', 'Student')->get();

        return view('backend.student.student_reg.student_list', $data);
    }
    public function StudentRegView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = StudentYear::orderBy('id', 'DESC')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'DESC')->first()->id;

        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();



        return view('backend.student.student_reg.student_view', $data);
    }

    // Chapter 18: Lecture: 14
    public function StudentYearClassWise(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();

        return view('backend.student.student_reg.student_view', $data);
    }


    public function StudentRegAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        return view('backend.student.student_reg.student_add', $data);
    }

    public function StudentRegStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $check_year = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();

            if ($student == NULL) {
                $firstReg = 0;
                $studentId = $firstReg + 1;

                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;

                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            }

            $final_id_no = $check_year . $id_no;
            $user = new User();

            $code = rand(0000, 9999);

            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;

            $assign_student->save();


            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student registration inserted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegEdit(Request $request, $student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editData']->toArray());

        return view('backend.student.student_reg.student_edit', $data);
    }


    public function StudentRegUpdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/', $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;

            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student registration updated successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegPromotion(Request $request, $student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editData']->toArray());

        return view('backend.student.student_reg.student_promote', $data);
    }

    public function StudentRegPromote(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/', $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            // $assign_student = AssignStudent::where('student_id', $student_id)->first();
            // dd($assign_student);
            //20210008


            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;

            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student promoted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegDetails(Request $request, $student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
