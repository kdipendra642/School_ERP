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
                    <h4 class="box-title">Employee Leave Edit</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('employee.leave.update', $editData->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Employee Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="employee_id" id="employee_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Employee</option>
                                                    @foreach($employees as $employe)
                                                    <option value="{{$employe->id}}" {{ ($editData->employee_id == $employe->id) ? "selected" : "" }}>{{$employe->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Leave Purpose<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Reason</option>
                                                    @foreach($leave_purpose as $leave)
                                                    <option value="{{$leave->id}}" {{ ($editData->leave_purpose_id == $leave->id ) ? "selected" : "" }}>{{$leave->name}}</option>
                                                    @endforeach
                                                    <option value="0">Other</option>
                                                </select>
                                                <input type="text" name="name" id="add_another" class="form-control" placeholder="Please mention reason for leave." style="display: none;">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Start Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $editData->start_date}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>End Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $editData->end_date}}">
                                            </div>
                                        </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change', '#leave_purpose_id', function() {
            var leave_purpose_id = $(this).val();
            if (leave_purpose_id == '0') {
                $('#add_another').show();
            } else {
                $('#add_another').hide();
            }
        })
    })
</script>

@endsection