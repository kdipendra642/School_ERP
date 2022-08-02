@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Employee Salary Increment Details</h3>
                            <hr>
                            <h5><strong>Employee Name: </strong> {{ $details->name }}</h5>
                            <h5><strong>Employee Id No: </strong> {{ $details->id_no }}</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Previous Salary</th>
                                            <th>Increment Salary</th>
                                            <th>Present Salary</th>
                                            <th>Effictive Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salary_log as $key => $log)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $log->previous_salary }}</td>
                                            <td>{{ $log->increment_salary }}</td>
                                            <td>{{ $log->present_salary }}</td>
                                            <td>{{ date('d-m-Y', strtotime($log->effected_salary)) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>
<!-- /.content-wrapper -->

@endsection