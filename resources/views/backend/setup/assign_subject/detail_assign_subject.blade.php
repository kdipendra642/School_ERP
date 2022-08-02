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
                            <h3 class="box-title">Assign Subject Details</h3>
                            <a href="{{ route('assign.subject.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Assign Subject</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h4>Assigned Subject: <strong>{{ $detailData['0']['student_class']['name'] }}</strong></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SN</th>
                                            <th>Subject</th>
                                            <th>Pass Mark</th>
                                            <th>Pass Mark</th>
                                            <th>Subjective Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailData as $key => $details)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $details['school_subject']['name'] }}</td>
                                            <td>{{ $details->full_mark }}</td>
                                            <td>{{ $details->pass_mark }}</td>
                                            <td>{{ $details->subjective_mark }}</td>
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