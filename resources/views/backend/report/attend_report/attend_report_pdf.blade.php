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
                <p><b>Employee Attendance Fee</b></p>

            </td>
        </tr>
    </table>
    <br>
    <br>
    <strong>Employee Name: </strong> {{ $allData['0']['user']['name']}},
    <strong>ID No: </strong> {{ $allData['0']['user']['id_no']}},
    <strong>Month: </strong> {{$month}}

    <table id="customers">
        <tr>
            <th width="50%">Date</th>
            <th width="50%">Attend Status</th>
        </tr>
        @foreach($allData as $value)
        <tr>
            <td width="50%">{{ date('d-m-Y', strtotime($value->date)) }}</td>
            <td width="50%">{{$value->attend_status}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Absent: </strong>{{$absents }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Total Leave: </strong>{{$leaves }}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>