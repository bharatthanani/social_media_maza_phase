@extends('admin.master')
@section('title') <title>All Users</title> @stop
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Users</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th width="10%">SrNo</th>
                                        <th width="30%">First Name</th>
                                        <th width="30%">Last Name</th>
                                        <th width="10%">Email</th>
                                        <th width="10%">CreatedOn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($records as $key=>$record)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$record['first_name']}}</td>
                                        <td>{{$record['last_name']}}</td>
                                        <td>{{$record['email']}}</td>
                                        <td>{{date('d M Y', strtotime($record['created_at']))}}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="10">Records Not Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('extra-script')
<script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
@stop