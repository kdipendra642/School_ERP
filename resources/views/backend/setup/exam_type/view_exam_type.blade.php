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
                            <h3 class="box-title">Exam Type List</h3>
                            <a href="{{ route('exam.type.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Exam Type</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th style="width: 70%;">Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $examtype)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $examtype->name }}</td>
                                            <td>
                                                <a href="{{ route('exam.type.edit', $examtype->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('exam.type.delete', $examtype->id) }}" class="btn btn-danger" id="delete">Delete</a>
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