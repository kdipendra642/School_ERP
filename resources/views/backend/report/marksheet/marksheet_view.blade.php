@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Manage Marksheet Generate</h4>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('report.marksheet.get') }}" method="get" target="_blank">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Year</h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Year</option>
                                                    @foreach($years as $year)
                                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Class</h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Class</option>
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Exam Type</h5>
                                            <div class="controls">
                                                <select name="exam_type_id" id="exam_type_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Exam Type</option>
                                                    @foreach($exam_type as $exam)
                                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>ID no <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="id_no" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection