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
            </td>
        </tr>
    </table>
    <br>
    @foreach($allData as $value)
    <table id="customers">
        <tr>
            <td>Image</td>
            <td>Easy School</td>
            <td>Student Id Card</td>
        </tr>
        <tr>
            <td>Name : {{ $value['student']['name'] }}</td>
            <td>Session : {{ $value['student_year']['name'] }}</td>
            <td>Class : {{ $value['student_class']['name'] }}</td>
        </tr>
        <tr>
            <td>Roll : {{ $value->roll }}</td>
            <td>Id No: {{ $value['student']['id_no'] }}</td>
            <td>Contact : {{ $value['student']['mobile'] }}</td>
        </tr>
    </table>
    @endforeach
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

</body>

</html>