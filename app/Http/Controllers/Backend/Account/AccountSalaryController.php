<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use App\Models\EmpoyeeSalaryLog;
use App\Models\EmployeeAttendance;
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    public function AccountSalaryView()
    {
        $data['allData'] = AccountEmployeeSalary::orderBy('id', 'DESC')->get();
        return view('backend.account.employee_salary.employee_salary_view', $data);
    }

    public function AccountSalaryAdd()
    {
        return view('backend.account.employee_salary.employee_salary_add');
    }

    public function AccountSalaryGetemployee(Request $request)
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
        $html['thsource'] .= '<th>Select</th>';


        foreach ($data as $key => $attend) {
            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();

            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            // code to reduce the salary from absent date 
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['id_no'] . '<input type="hidden" name="date" value="' . $date . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            // if you don't want to deduce salary then directly add the $salary value and comment the below code.
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary / 30;
            $deducesalary = (float)$absentcount * (float)$salaryperday;
            $finalsalary = (float)$salary - (float)$deducesalary;

            $html[$key]['tdsource'] .= '<td>' . $finalsalary . '<input type="hidden" name="amount[]" value="' . $finalsalary . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" id="' . $key . '" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="' . $key . '"> </label> ' . '</td>';
        }
        return response()->json(@$html);
    }

    public function AccountSalaryStore(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();

        $checkdata = $request->checkmanage;

        if ($checkdata != null) {
            for ($i = 0; $i < count($checkdata); $i++) {
                $data = new AccountEmployeeSalary();
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }

        if (!empty(@$data) || empty($checkdata)) {
            $notification = array(
                'message' => 'Well done data updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('account.salary.view')->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry data not saved.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
