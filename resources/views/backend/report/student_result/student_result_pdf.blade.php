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
                <p><b>Student Result Report</b></p>

            </td>
        </tr>
    </table>
    <br>
    <br>
    <strong>Result of: </strong> {{ $allData['0']['exam_type']['name']}}

    <table id="customers">
        <tr>
            <td width="50%">
                <h4>Year/Session</h4>
                <hr>
                {{ $allData['0']['year']['name']}}
            </td>
            <td width="50%">
                <h4>Class</h4>
                <hr>
                {{ $allData['0']['student_class']['name']}}
            </td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>