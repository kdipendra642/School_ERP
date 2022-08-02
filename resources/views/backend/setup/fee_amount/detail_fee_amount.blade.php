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
                            <h3 class="box-title">Fee Amount Details</h3>
                            <a href="{{ route('fee.amount.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Student Fee Amount</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h4>Fee Category: <strong>{{ $detailData['0']['fee_category']['name'] }}</strong></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SN</th>
                                            <th style="width: 70%;">Class Name</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailData as $key => $details)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $details['student_class']['name'] }}</td>
                                            <td>{{ $details->amount }}</td>
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