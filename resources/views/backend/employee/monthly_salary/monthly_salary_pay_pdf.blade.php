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
                <!-- <p><b>Student Monthly Fee</b></p> -->

            </td>
        </tr>
    </table>
    <br>

    @php
    $date = date('Y-m', strtotime($details['0']->date));
    if ($date != '') {
    $where[] = ['date', 'like', $date . '%'];
    }


    $totalattend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $details['0']->employee_id)->get();
    $salary = (float)$details['0']['user']['salary'];
    $salaryperday = (float)$salary/30;
    $absentcount = count($totalattend->where('attend_status', 'Absent'));
    $totalminussalary = (float)$absentcount * (float)$salaryperday;
    $totalsalary = (float)$salary - (float)$totalminussalary;
    @endphp
    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee ID</b></td>
            <td>{{$details['0']['user']['id_no']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee Name</b></td>
            <td>{{$details['0']['user']['name']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Base Salary</b></td>
            <td>{{$details['0']['user']['salary']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Total Absent For This Month</b></td>
            <td>{{ $absentcount }}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Salary For The Month of ( {{date('Y-m-d', strtotime($details['0']->date))}})</b></td>
            <td>{{ $totalsalary }}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee ID</b></td>
            <td>{{$details['0']['user']['id_no']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee Name</b></td>
            <td>{{$details['0']['user']['name']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Base Salary</b></td>
            <td>{{$details['0']['user']['salary']}}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Total Absent For This Month</b></td>
            <td>{{ $absentcount }}</td>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Salary For The Month of ({{ date('Y-m-d', strtotime($details['0']->date))}})</b></td>
            <td>{{ $totalsalary }}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

</body>

</html>