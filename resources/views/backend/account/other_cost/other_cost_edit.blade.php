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
                    <h4 class="box-title">Add Employee</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('other.cost.update', $editData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Amount <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="amount" id="amount" class="form-control" required value="{{ $editData->amount }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" id="date" class="form-control" required value="{{ $editData->date }}">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-none">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" id="image" class="form-control" value="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/cost_images/'.$editData->image) : url('upload/no_image.jpg') }}" alt="{{$editData->description }}" style="width: 100px; height: 100px; border: 1px solid #000;">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Description <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="description" id="description" class="form-control" required placeholder="Expense Detail" aria-invalid="false">{{ $editData->description }}</textarea>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-3" value="Submit">
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