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
    $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id', '2')->where('class_id', $details->class_id)->first();
    $originalfee = $registrationfee->amount;
    $discount = $details['discount']['discount'];
    $discountablefee = $discount/100*$originalfee;
    $finalfee = (float)$originalfee - (float)$discountablefee;
    @endphp
    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Student Details</th>
            <th width="45%">Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Student ID</b></td>
            <td>{{$details['student']['id_no']}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Roll No</b></td>
            <td>{{$details->roll}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Name</b></td>
            <td>{{$details['student']['name']}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Fathers Name</b></td>
            <td>{{$details['student']['fname']}}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Session Number</b></td>
            <td>{{$details['student_year']['name']}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td><b>Class</b></td>
            <td>{{$details['student_class']['name']}}</td>
        </tr>
        <tr>
            <td>7</td>
            <td><b>Monthly Fee</b></td>
            <td>Rs. {{$originalfee}}</td>
        </tr>
        <tr>
            <td>8</td>
            <td><b>Discount %</b></td>
            <td>{{$discount}} %</td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Total (For the month of {{$month}})</b></td>
            <td>Rs. {{$finalfee}}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px;">

    <table id="customers">
        <tr>
            <th width="10%">SN</th>
            <th width="45%">Student Details</th>
            <th width="45%">Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Student ID</b></td>
            <td>{{$details['student']['id_no']}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Roll No</b></td>
            <td>{{$details->roll}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Name</b></td>
            <td>{{$details['student']['name']}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Fathers Name</b></td>
            <td>{{$details['student']['fname']}}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Session Number</b></td>
            <td>{{$details['student_year']['name']}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td><b>Class</b></td>
            <td>{{$details['student_class']['name']}}</td>
        </tr>
        <tr>
            <td>7</td>
            <td><b>Monthly Fee</b></td>
            <td>Rs. {{$originalfee}}</td>
        </tr>
        <tr>
            <td>8</td>
            <td><b>Discount %</b></td>
            <td>{{$discount}} %</td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Total (For the month of {{$month}})</b></td>
            <td>Rs. {{$finalfee}}</td>
        </tr>
    </table>
    <br>
    <i style="font-size: 10px; float: right;"></i> Print Date: {{ date("d M Y") }}

</body>

</html>