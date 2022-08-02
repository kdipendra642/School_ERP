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
                            <h3 class="box-title">Other Expense List</h3>
                            <a href="{{ route('other.cost.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Other Cost</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->amount }}</td>

                                            <td>
                                                <a href="{{ route('other.cost.edit', $value->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('other.cost.delete', $value->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                                <a href="{{ route('other.cost.details', $value->id) }}" target="_blank" class="btn btn-primary">PDF</a>
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