@extends('front.master')
@section('title') Messages @stop
@section('main-content')
<section class="edit-profile-sec">
    <div class="container">
        <div class="row edit-profile-row">
            <div class="col-lg-7 col-12">
                <div class="left-edit-box">
                    <h1 class="top-heading">Edit Profile</h1>	
                    <form class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="name" placeholder="Jason">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="name" placeholder="Smith">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" placeholder="jasonsmith@lorem.com">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input type="tel" placeholder="123-458-524">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="email" placeholder="Lorem ipdum dummy text 1234, New York City, USA">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">City</label>
                                <select>
                                    <option>Mccallen</option>
                                    <option>LA</option>
                                    <option>CA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">State</label>
                                <select>
                                    <option>New York</option>
                                    <option>LA</option>
                                    <option>CA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" placeholder="*******">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button class="save-btn">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop