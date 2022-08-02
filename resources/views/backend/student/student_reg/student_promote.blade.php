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
                    <h4 class="box-title">Promote Student</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('promote.student.registration', $editData->student_id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editData->id }}">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Year</option>
                                                    @foreach($years as $year)
                                                    <option value="{{$year->id}}" {{ $editData->year_id == $year->id ? "selected" : "" }}>{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Class</option>
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}" {{ $editData->class_id == $class->id ? "selected" : "" }}>{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Group <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="group_id" id="group_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Group</option>
                                                    @foreach($groups as $group)
                                                    <option value="{{$group->id}}" {{ $editData->group_id == $group->id ? "selected" : "" }}>{{$group->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Shift <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="shift_id" id="shift_id" required="" class="form-control">
                                                    <option value="" selected="" disabled>Select Year</option>
                                                    @foreach($shifts as $shift)
                                                    <option value="{{$shift->id}}" {{ $editData->shift_id == $shift->id ? "selected" : "" }}>{{$shift->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <img id="showImage" src="{{ (!empty($editData['student']['image'])) ? url('upload/student_images/'.$editData['student']['image']) : url('upload/no_image.jpg') }}" alt="{{$editData['student']['name'] }}" style="width: 100px; height: 100px; border: 1px solid #000;">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-3" value="Promote">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    })
</script>

@endsection