<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use PDF;

class ProfitController extends Controller
{
    public function MonthlyView()
    {
        return view('backend.report.profit.profit_view');
    }

    public function MonthlyProfitDateWise(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;

        $net_profit = $student_fee - $total_cost;

        $html['thsource']  = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Net Profit</th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';

        $html['tdsource'] = '<td>' . 'Rs ' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . 'Rs ' . $other_cost . '</td>';
        $html['tdsource'] .= '<td>' . 'Rs ' . $emp_salary . '</td>';
        $html['tdsource'] .= '<td>' . 'Rs ' . $total_cost . '</td>';
        // $html['tdsource'] .= '<td>' . 'Rs ' . $net_profit . '</td>';
        if ($net_profit < 0) {
            $html['tdsource'] .= '<td style="color: red;">' . 'Rs ' . $net_profit . '</td>';
        } else {
            $html['tdsource'] .= '<td style="color: green;">' . 'Rs ' . $net_profit . '</td>';
        }
        $html['tdsource'] .= '<td><a class="btn btn-sm btn-' . $color . '" title="DownloadSlip" target="_blanks" href="' . route("monthly.profit.report.pdf") . '?start_date=' . $sdate . '&end_date=' . $edate . '">Download Slip</a></td>';
        return response()->json(@$html);
    }

    public function MonthlyProfitGenPdf(Request $request)
    {
        $data['start_date'] = date('Y-m', strtotime($request->start_date));
        $data['end_date'] = date('Y-m', strtotime($request->end_date));
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate'] = date('Y-m-d', strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.profit.profit_view_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
