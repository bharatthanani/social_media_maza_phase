@extends('admin.master')
@section('title') <title>Dashboard</title> @stop
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Help & Support</h4>
                        <a class="float-right" href="{{route('addHelpSupport')}}">
                            <button type="submit" class="btn login-form__btn submit">ADD HELP & SUPPORT</button>
                        </a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th width="10%">SrNo</th>
                                        <th width="20%">Title</th>
                                         <th width="40%">Description</th>
                                        <th width="20%">AddedOn</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($records as $key=>$record)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$record['title']}}</td>
                                        <td>{{$record['description']}}</td>
                                        <td>{{date('d M Y', strtotime($record['created_at']))}}</td>
                                        <td><span><a href="{{ url('admin/editHelpSupport/'.$record['id'])}}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                    href="{{ url('admin/deleteHelpSupport/'.$record['id'])}}"
                                                    data-toggle="tooltip" data-placement="top" title="Close" onclick="return confirm('Are you sure you want to delete this item')"><i
                                                        class="fa fa-close color-danger"></i></a></span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Records Not Found</td>
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