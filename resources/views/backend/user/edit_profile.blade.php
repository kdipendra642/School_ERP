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
                    <h4 class="box-title">Update User</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>User Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>User Email <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" name="email" class="form-control" required="" value="{{ $editData->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>Mobile <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="tel" name="mobile" class="form-control" required="" value="{{ $editData->mobile }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>User Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" class="form-control" required="" value="{{ $editData->address }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Gender<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="gender" id="gender" required="" class="form-control">
                                                            <option value="" selected="" disabled>Select gender</option>
                                                            <option value="Male" {{$editData->gender == "Male" ? "selected" : ""}}>Male</option>
                                                            <option value="Female" {{$editData->gender == "Female" ? "selected" : ""}}>Female</option>
                                                            <option value="Other" {{$editData->gender == "Other" ? "selected" : ""}}>Other</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>Image <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" id="image" class="form-control" value="{{ $editData->image }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/user_images/'.$editData->image) : url('upload/no_image.jpg') }}" alt="{{$editData->name }}" style="width: 100px; height: 100px; border: 1px solid #000;">
                                                        </div>
                                                    </div>
                                                </div>
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