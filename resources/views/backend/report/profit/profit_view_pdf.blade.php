<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>


    <table id="customers">
        <tr>
            <td>
                <h2><?php $image_path = '/upload/easyschool.png'; ?></h2>
                <img src="{{ public_path() . $image_path}}" style="width: 200px; height: 100px;">
            </td>
            <td>
                <h2>Easy School ERP</h2>
                <hr>
                <p>Phone: 9813666961</p>
                <p>Email: kdipendra642@gmail.com</p>
                <p>Address: Kathmandu, Nepal</p>
                <p><b>Monthly/Yearly Profit</b></p>

            </td>
        </tr>
    </table>
    <br>

    @php
    $student_fee = App\Models\AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
    $other_cost = App\Models\AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
    $emp_salary = App\Models\AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

    $total_cost = $other_cost + $emp_salary;

    $net_profit = $student_fee - $total_cost;
    @endphp
    <table id="customers">
        <tr>
            <td colspan="2" style="text-align: center;">
                <h4>Reporting Date: {{ date('d M Y', strtotime($sdate)) }} - {{ date('d M Y', strtotime($edate)) }}</h4>
            </td>
        </tr>
        <tr>
            <td width="50%">Student Fee</td>
            <td width="50%">Rs. {{$student_fee}}</td>
        </tr>
        <tr>
            <td width="50%">Employee Salary</td>
            <td width="50%">Rs. {{ $emp_salary }}</td>
        </tr>
        <tr>
            <td width="50%">Other Cost</td>
            <td width="50%">Rs. {{$other_cost}}</td>
        </tr>
        <tr>
            <td width="50%">Total Expense</td>
            <td width="50%">Rs. {{$total_cost}}</td>
        </tr>
        <tr>
            <td width="50%">Net Profit</td>
            <td width="50%">Rs. {{$net_profit}}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>