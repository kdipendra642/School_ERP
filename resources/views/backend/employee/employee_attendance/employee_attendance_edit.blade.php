@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Attandance</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('store.employee.attendance') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Attandance Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" id="date" class="form-control" value="{{ $editData['0']['date'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">SN</th>
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">Employee List</th>
                                                    <th class="text-center" colspan="3" style="vertical-align: middle; width: 25%;">Attendance Status</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center btn present_all" style="display: table-cell; background-color:#000;">Present</th>
                                                    <th class="text-center btn present_all" style="display: table-cell; background-color:#000;">Leave</th>
                                                    <th class="text-center btn present_all" style="display: table-cell; background-color:#000;">Absent</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach($editData as $key=> $data)
                                                <tr id="div{{$data->id}}" class="text-center">
                                                    <input type="hidden" name="employee_id[]" value="{{ $data->employee_id }}">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$data['user']['name']}}</td>
                                                    <td colspan="3">
                                                        <div class="switch-toggle switch-3 switch-candy">
                                                            <input type="radio" name="attend_status{{$key}}" id="present{{$key}}" value="Present" checked {{($data->attend_status == 'Present') ? 'checked' : ''}}>
                                                            <label for="present{{$key}}">Present</label>
                                                            <input type="radio" name="attend_status{{$key}}" id="leave{{$key}}" value="Leave" {{($data->attend_status == 'Leave') ? 'checked' : '' }}>
                                                            <label for="leave{{$key}}">Leave</label>
                                                            <input type="radio" name="attend_status{{$key}}" id="absent{{$key}}" value="Absent" {{($data->attend_status == 'Absent') ? 'checked' : ''}}>
                                                            <label for="absent{{$key}}">Absent</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-3" value="Update">
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

    </div>
</div>

@endsection