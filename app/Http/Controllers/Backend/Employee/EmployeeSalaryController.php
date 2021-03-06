<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use PDF;
use App\Models\Designation;
use App\Models\EmpoyeeSalaryLog;

class EmployeeSalaryController extends Controller
{
    public function EmployeeSalaryView()
    {
        $data['allData'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_salary.employee_salary_view', $data);
    }

    public function EmployeeSalaryIncrement(Request $request, $id)
    {
        $data['editData'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment', $data);
    }

    public function EmployeeSalaryUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmpoyeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Employee Salary Increment Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.salary.view')->with($notification);
    }

    public function EmployeeSalaryDetails(Request $request, $id)
    {
        $data['details'] = User::find($id);
        $data['salary_log'] = EmpoyeeSalaryLog::where('employee_id', $data['details']->id)->get();

        return view('backend.employee.employee_salary.employee_salary_details', $data);
    }
}
