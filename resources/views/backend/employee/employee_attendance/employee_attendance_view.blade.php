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
                            <h3 class="box-title">Employee Attandance</h3>
                            <a href="{{ route('employee.attendance.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Attandance</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th style="width: 25%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                            <td>
                                                <a href="{{ route('employee.attendance.edit', $value->date) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('employee.attendance.details', $value->date) }}" class="btn btn-danger" id="details">Details</a>
                                            </td>
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