<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use PDF;
use App\Models\Designation;
use App\Models\EmpoyeeSalaryLog;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

class EmployeeLeaveController extends Controller
{
    public function EmployeeLeaveView()
    {
        $data['allData'] = EmployeeLeave::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_leave.employee_leave_view', $data);
    }

    public function EmployeeLeaveAdd()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.employee_leave.employee_leave_add', $data);
    }

    public function EmployeeLeaveStore(Request $request)
    {
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();

            $leave_purpose_id = $leavepurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message' => 'Employee leave data inserted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }

    public function EmployeeLeaveEdit($id)
    {
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype', 'employee')->get();
        // dd($data['employees']->toArray());

        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.employee_leave.employee_leave_edit', $data);
    }

    public function EmployeeLeaveUpdate(Request $request, $id)
    {
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();

            $leave_purpose_id = $leavepurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->update();

        $notification = array(
            'message' => 'Employee leave data updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }

    public function EmployeeLeaveDelete(Request $request, $id)
    {
        $leave = EmployeeLeave::find($id);
        $leave->delete();

        $notification = array(
            'message' => 'Employee leave data deleted successfully.',
            'alert-type' => 'warning'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }
}
