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
                            <h3 class="box-title">Student List</h3>
                            <a href="{{ route('student.registration.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Student</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Image</th>
                                            @if(Auth::user()->role == "Admin")
                                            <th>Code</th>
                                            @endif
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $key => $value )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td> {{ $value->name }}</td>
                                            <td> {{ $value->id_no }}</td>
                                            <td> {{ $value->mobile }}</td>
                                            <td> {{ $value->address }}</td>
                                            <td> {{ $value->gender }}</td>
                                            <td>
                                                <img src="{{ (!empty($value->image))? url('upload/student_images/'.$value->image):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                            </td>
                                            <!-- <td> {{ $value->year_id }}</td> -->
                                            @if(Auth::user()->role == "Admin")
                                            <td>{{ $value->code }}</td>
                                            @endif
                                            <td>
                                                <a title="Details" target="_blank" href="{{ route('student.registration.details', $value->id ) }}" class="btn btn-danger"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection