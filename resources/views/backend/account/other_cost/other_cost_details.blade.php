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
                <p><b>Expense Details</b></p>

            </td>
        </tr>
    </table>
    <br>

    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Date</b></td>
            <td>{{$details->date}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Description</b></td>
            <td>{{$details->description}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Amount</b></td>
            <td>Rs. {{$details->amount}}</td>
        </tr>

    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

</body>

</html>