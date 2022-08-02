<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use PDF;
use App\Models\Designation;
use App\Models\EmpoyeeSalaryLog;
use App\Models\EmployeeAttendance;

class MonthlySalaryController extends Controller
{
    public function MonthlySalaryView()
    {
        return view('backend.employee.monthly_salary.monthly_salary_view');
    }

    public function MonthlySalaryGet(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Base Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            // code to reduce the salary from absent date 
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            // if you don't want to deduce salary then directly add the $salary value and comment the below code.
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary / 30;
            $deducesalary = (float)$absentcount * (float)$salaryperday;
            $finalsalary = (float)$salary - (float)$deducesalary;

            $html[$key]['tdsource'] .= '<td>' . $finalsalary . 'Rs' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("employee.monthly.salary.payslip", $attend->employee_id) . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function MonthlySalaryPaySlip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m', strtotime($id->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();

        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly_salary_pay_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
