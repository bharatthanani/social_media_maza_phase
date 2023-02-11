@extends('admin.master')
@section('title') <title>Edit Help & Support</title> @stop
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" style="background-color: #F3F3F9;">
                        <div class="container h-100">
                            <div class="row justify-content-center h-100">
                                <div class="col-xl-12">
                                    <div class="form-input-content">
                                        <div class="card login-form mb-0">
                                            <div class="card-body pt-5" style="background-color: #FFFFFF;">
                                                <a class="text-center" href="javascript:void(0)">
                                                    <h4>EDIT HELP & SUPPORT</h4>
                                                </a>

                                                <form class="mt-5 mb-5 login-input" method="POST"
                                                    action="{{url('admin/updatehelpSupportProcess/'.$record->id)}}">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <label><b>HELP & SUPPORT TITLE</b></label>
                                                        <input type="text" placeholder="HELP & SUPPORT TITLE" id="title"
                                                            class="form-control" name="title" required value="{{$record->title??''}}" autofocus>
                                                        @if ($errors->has('title'))
                                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label><b>HELP & SUPPORT DESCRIPTION</b></label>
                                                        <textarea class="form-control editor" rows="3" id="description" name="description" required>{{$record->description??''}}</textarea>
                                                        @if ($errors->has('description'))
                                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                                        @endif
                                                    </div>
                                                    <button type="submit" class="btn login-form__btn submit w-100">UPDATE
                                                        HELP & SUPPORT</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop