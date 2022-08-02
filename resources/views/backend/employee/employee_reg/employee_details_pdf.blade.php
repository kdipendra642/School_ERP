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

    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee ID</b></td>
            <td>{{$details->id_no}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Name</b></td>
            <td>{{$details->name}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Fathers Name</b></td>
            <td>{{$details->fname}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Joining Date</b></td>
            <td>{{ date('d-m-Y', strtotime($details->join_date)) }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Mobile</b></td>
            <td>{{$details->mobile}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td><b>Address</b></td>
            <td>{{$details->address}}</td>
        </tr>
        <tr>
            <td>7</td>
            <td><b>Gender</b></td>
            <td>{{$details->gender}}</td>
        </tr>
        <tr>
            <td>8</td>
            <td><b>Salary</b></td>
            <td>{{$details->salary}}</td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Designation</b></td>
            <td>{{$details['designation']['name']}}</td>
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
            <td>{{$details->id_no}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Name</b></td>
            <td>{{$details->name}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Fathers Name</b></td>
            <td>{{$details->fname}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Joining Date</b></td>
            <td>{{ date('d-m-Y', strtotime($details->join_date)) }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Mobile</b></td>
            <td>{{$details->mobile}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td><b>Address</b></td>
            <td>{{$details->address}}</td>
        </tr>
        <tr>
            <td>7</td>
            <td><b>Gender</b></td>
            <td>{{$details->gender}}</td>
        </tr>
        <tr>
            <td>8</td>
            <td><b>Salary</b></td>
            <td>{{$details->salary}}</td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Designation</b></td>
            <td>{{$details['designation']['name']}}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

</body>

</html>