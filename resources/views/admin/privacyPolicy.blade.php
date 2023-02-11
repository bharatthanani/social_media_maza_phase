@extends('admin.master')
@section('title') <title>Privacy Policy</title> @stop
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
                                                    <h4>Update Privacy Policy</h4>
                                                </a>

                                                <form class="mt-5 mb-5 login-input" method="POST"
                                                    action="{{route('updatePrivacyPolicy')}}">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <label id="heading_1"><b>Heading One</b></label>
                                                        <input type="text" placeholder="Heading One" id="heading_1"
                                                            class="form-control" name="heading_1" value="<?= $record['heading_1']?>" >
                                                        @if ($errors->has('heading_1'))
                                                        <span class="text-danger">{{ $errors->first('heading_1') }}</span>
                                                        @endif
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label><b>Heading One Description</b></label>
                                                        <textarea class="form-control editor" rows="3" id="heading_1_des" name="heading_1_des"><?= $record['heading_1_des']?></textarea>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label id="heading_2"><b>Heading Two</b></label>
                                                        <input type="text" placeholder="Heading Two" id="heading_2"
                                                            class="form-control" name="heading_2" value="<?= $record['heading_2']?>" >
                                                        @if ($errors->has('heading_2'))
                                                        <span class="text-danger">{{ $errors->first('heading_2') }}</span>
                                                        @endif
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label><b>Heading Two Description</b></label>
                                                         <textarea class="form-control editor" rows="3" id="heading_2_des" name="heading_2_des"><?= $record['heading_2_des']?></textarea>
                                                        @if ($errors->has('heading_2_des'))
                                                        <span class="text-danger">{{ $errors->first('heading_2_des') }}</span>
                                                        @endif
                                                    </div>
                                                    </div> 
                                            <button type="submit" class="btn login-form__btn submit w-100">UPDATE Privacy Policy</button>
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
@stop
@section('extra-script')
@endsection