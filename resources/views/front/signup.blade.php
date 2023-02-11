
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Maze Phaze</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="{{asset('assetsfront/images/favicon.png')}}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="{{asset('assetsfront/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/stellarnav.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/font-awesome.css')}}">
	<link rel="stylesheet" href="{{asset('assetsfront/css/swiper-bundle.min.css')}}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('assetsfront/css/jquery.fancybox.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/style.css')}}" />
	<link rel="stylesheet" href="{{asset('assetsfront/css/responsive.css')}}" />
    <link rel="stylesheet" href="{{asset('assetsfront/css/toastr.min.css')}}" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
    .loginPageWrap {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }
    .loginPageWrap .loginSec .leftWrap{
        position: relative;
        background: url("{{asset('assetsfront/images/left-back-2.png')}}");
        background-repeat: no-repeat;
        background-size: cover;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        z-index: 1;
    }
    .loginPageWrap .loginSec .leftWrap::before{
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to left bottom, #f59313, #f79115, #fa9017e0, #fc8e1ae3, #fe8c1cd1);
        z-index: -1;
    }
    .titleBold{
        font-family: 'Montserrat';
        font-size: 48px;
        font-weight: 800;
        color: #fff;
        line-height: 1
    }
    .textLight{
        font-family: 'Montserrat';
        font-size: 24px;
        font-weight: 400;
        color: #fff;
    }
    .loginPageWrap .top-right {
        position: absolute;
        top: 0%;
        right: 0%;
    }
    .loginPageWrap .top-center {
        position: absolute;
        top: 0%;
        left: 15%;
        z-index: -1;
    }
    .logoWrap{
        text-align: center;
        margin-top: 80px;
    }
    .loginSignUpWrap .connect-box{
        text-align: center;
        margin-bottom: 30px;
    }
    .connect-inner{
        position: relative;
        width: 45%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
    }
    .connect-inner::after{
        content: '';
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 3px;
        background: #d5d5d5;
        left: 0%;
        right: 0%;
        margin: 0 auto;
    }
    .connect-btn{
        color: #d5d5d5;
        font-size: 25px;
        text-transform: uppercase;
        border: none;
        outline: none;
        background: transparent;
        font-weight: 600;
        position: relative;
    }
    .connect-btn.active,
    .connect-btn:hover{
        color: #ff7800;
    }
    .connect-btn.active::before {
        content: '';
        position: absolute;
        top: 34px;
        height: 3px;
        background: #ff7800;
        width: 100%;
        z-index: 1;
    }
    .loginSignUpWrap input{
        box-shadow: none !important;
        outline: none !important;
        padding-left: 0;
    }
    .loginSignUpWrap input::placeholder{
        font-size: 12px;
        font-weight: #282828;
        font-weight: 500;
    }
    .loginSignUpWrap .input-group{
        border: 1px solid #282828;
        outline: none;
        box-shadow: none !IMPORTANT;
    }
    .loginSignUpWrap .input-group .input-group-text{
        background: transparent;
    }
    .loginSignUpWrap .form-control{
        border: none;
    }
    .forgotLink{
        text-align: right;
        margin-bottom: 10px;
    }
    .forgotLink a {
        font-size: 12px;
        font-weight: 600;
        color: #282828;
        text-decoration: none;
    }
    .submitBtn {
        height: 50px;
        width: 100%;
        border: none;
        outline: none;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(to left bottom, #f59313, #f79115, #fa9017e0, #fc8e1ae3, #fe8c1cd1);
    }
    .socialTitle{
        margin: 15px 0;
        color: #282828;
        font-size: 15px;
        font-weight: 500;
    }
    .socialLinks{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
    .socialLinks span{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 20px;
    }
    .switchScreenText{
        font-size: 15px;
        font-weight: 500;
        color: #282828;
    }
    .switchScreenText a{
        font-weight: 800;
        text-decoration: none;
        color: #282828;
    }
    /* flip effect   */
    .flip-card-3D-wrapper {
      width: 100%;
      height: 100%;
      max-width: 500px;
      max-height: 500px;
      position: relative;
      -o-perspective: 900px;
      -webkit-perspective: 900px;
      -ms-perspective: 900px;
      perspective: 900px;
      margin: 0 auto;
  }
  .flip-card {
      width: 100%;
      height: 100%;
      text-align: center;
      margin: 50px auto;
      position: absolute;
      transition: all 1s ease-in-out;
      -o-transform-style: preserve-3d;
      -webkit-transform-style: preserve-3d;
      -ms-transform-style: preserve-3d;
      transform-style: preserve-3d;
  }
  #signBack-card {
      width: 100%;
      height: 100%;
      text-align: center;
      margin: 50px auto;
      position: absolute;
      -o-transition: all 1s ease-in-out;
      -webkit-transition: all 1s ease-in-out;
      -ms-transition: all 1s ease-in-out;
      transition: all 1s ease-in-out;
      -o-transform-style: preserve-3d;
      -webkit-transform-style: preserve-3d;
      -ms-transform-style: preserve-3d;
      transform-style: preserve-3d;
  }
  .do-flip {
      -o-transform: rotateY(-180deg);
      -webkit-transform: rotateY(-180deg);
      -ms-transform: rotateY(-180deg);
      transform: rotateY(-180deg);
  }
  .flip-card .flip-card-front, .flip-card .flip-card-back{
      width: 100%;
      height: auto;
      position: absolute;
      -o-backface-visibility: hidden;
      -webkit-backface-visibility: hidden;
      -ms-backface-visibility: hidden;
      backface-visibility: hidden;
      z-index: 2;
      box-shadow: 0px 0px 45px 0px #cccccc85;
      padding: 30px;
      border-radius: 10px;  
  }
  .flip-card .flip-card-front {
      background: transparent;
      border: none;
  }
  .flip-card .flip-card-back {
      -o-transform: rotateY(180deg);
      -webkit-transform: rotateY(180deg);
      -ms-transform: rotateY(180deg);
      transform: rotateY(180deg);
  }
  .gen-modal .form-group input, .gen-modal .form-group select {
    width: 100%;
    height: 45px;
    border: 1px solid #000;
    outline: none;
    padding-left: 20px;
    font-size: 14px;
    color: #2c2c2c;
    margin-bottom: 10px;
}
.gen-modal .form-group input:placeholder {
  color: #ababab;
} 
.gen-modal .form-group select {
  color: #ababab;
}
.gen-modal .form-group select option {
  color: #2c2c2c;
}
.gen-modal .form-group.type-1 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  line-height: 0;
}
.gen-modal .form-group.type-1 input {
  max-width: 230px;
  width: 100%;
}
.gen-modal .submit-btn {
    width: 100%;
    height: 45px;
    background: #f8941a;
    padding: 14px 20px;
    margin: 8px 0;
    border: 0;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    text-transform: uppercase;
    transition: all 0.25s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.gen-modal .heading {
    font-size: 30px;
    text-align: center;
    color: #2c2c2c;
}
.gen-modal .close-btn {
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 13px;
    color: #fff;
    border-radius: 100%;
    border: 0;
    background: #f8941a;
    position: absolute;
    top: 10px;
    right: 10px;
}
.gen-modal .modal-header {
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.gen-modal .modal-content {
    border: 0;
    border-radius: 15px;
    padding: 40px 30px;
}
.otp-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 380px;
    margin: 0 auto;
}
#otp-modal input {
    width: 50px;
    height: 50px;
    padding: 0;
    font-size: 22px;
    padding-left: 18px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.resend-btn {
    border: 0;
    max-width: 100px;
    background: #fff;
    font-size: 16px;
    color: #2c2c2c;
}


</style>
<body>

<div class="loginPageWrap">
    <section class="loginSec">
        <div class="row m-0">
            <div class="col-12 col-md-12 col-lg-6 col-sm-12 p-0">
                <div class="leftWrap">
                    <p class="titleBold">Adventure Starts Here</p>
                    <p class="textLight">Create An Account to Join the Community.</p>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-sm-12 p-0">
                <div class="rightWrap">
                    <div class="logoWrap">
                        <img src="{{asset('assetsfront/images/logo.png')}}" alt="logo">
                    </div>
                    <!-- login & SignUp Wrap Starts -->
                    <div class="loginSignUpWrap">
                        <div class="flip-card-3D-wrapper">
                            <div class="flip-card">
                                <div class="flip-card-front">
                                    <div class="connect-box front-screen">
                                        <div class="connect-inner">
                                            <button class="connect-btn flip-card-btn-turn-to-back active" data-card="login-bck">Login</button>
                                            <button class="connect-btn blue-btn back-btn flip-card-btn-turn-to-front" data-card="signup-bck">Sign Up</button>
                                        </div>
                                    </div>
                                    <div class="connect-box loginBack login-bck show-hide">
                                        <form class="loginBack-form" id="signinForm" action="{{ route('signinProcess') }}" method="POST">
                                            @csrf
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                                                <input type="text" name="email" class="form-control" placeholder="Your Email" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                <input type="password" name="password" class="form-control" placeholder="Your Password" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <p class="forgotLink"> <a href="#forgot-password-modal" class="" data-bs-toggle="modal"  role="button" >Forgot Password?</a> </p>
                                            <button type="submit" class="submitBtn">LOGIN</button>
                                        </form>
                                        <!-- <p class="socialTitle"> or connect using </p>
                                        <div class="socialLinks">
                                            <span> <a href="#!"> <img src="{{asset('assetsfront/images/facebook.png')}}" alt="facebook icon" class="img-fluid"> </a> </span>
                                            <span> <a href="#!"> <img src="{{asset('assetsfront/images/g-plus.png')}}" alt="Google plus icon" class="img-fluid"> </a> </span>
                                            <span> <a href="#!"> <img src="{{asset('assetsfront/images/twiter.png')}}" alt="Twitter icon" class="img-fluid"> </a> </span>
                                        </div> -->
                                        <div class="back-button">
                                            <p class="switchScreenText">Don't have an account? <a href="#!" class="back-btn flip-card-btn-turn-to-front">Sign Up</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flip-card-back loginBack">
                                    <div class="connect-box front-screen">
                                        <div class="connect-inner">
                                            <button class="connect-btn flip-card-btn-turn-to-back" data-card="login-bck">Login</button>
                                            <button class="connect-btn blue-btn back-btn flip-card-btn-turn-to-front active" data-card="signup-bck">Sign Up</button>
                                        </div>
                                    </div>
                                    <div class="connect-box signBack signup-bck show-hide">
                                        <form class="loginBack-form" id="signupForm" action="{{ route('signupProcess') }}" method="POST">
                                            @csrf
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                                <input type="text" name="first_name" class="form-control" placeholder="Your First Name" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                                <input type="text" name="last_name" class="form-control" placeholder="Your Last Name" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                                                <input type="email"  name="email" class="form-control" placeholder="Your Email" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Your Password" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group mb-3 p-0">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Re-Type Password" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>

                                            <div>
                                                <button type="submit" class="submitBtn">SignUp</button>
                                            </div>
                                        </form>
                                        <div class="back-button mt-4">
                                            <p class="switchScreenText">Already have an account? <a href="#!" class="back-btn flip-card-btn-turn-to-back">Login Here</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- login & SignUp Wrap Ends -->
                </div>             
            </div>
        </div>
    </section>
    <img src="{{asset('assetsfront/images/right-extra.png')}}" alt="image" class="img-fluid top-right">
    <img src="{{asset('assetsfront/images/right-extra-1.png')}}" alt="image" class="img-fluid top-center">
</div>


<!-- CHANGE PASSWORD MODAL -->

<div class="modal fade gen-modal" id="forgot-password-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="img-box mb-4">
                    <img src="{{asset('assetsfront/images/header-logo.png')}}">
                </div>
                <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <h1 class="heading">Forgot Password</h1>
            </div>
            <div class="modal-body p-0">
                <form action="">
                    <ul class="list-unstyled">
                        <li class="form-group">
                            <input type="email" placeholder="Enter Email">
                        </li>
                        <li class="form-group">
                            <a class="submit-btn" href="#otp-modal" class="" data-bs-toggle="modal"  role="button">Reset</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CHANGE PASSWORD MODAL -->

<!-- OTP MODAL -->

<div class="modal fade gen-modal" id="otp-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="img-box mb-4">
                    <img src="{{asset('assetsfront/images/header-logo.png')}}">
                </div>
                <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <h1 class="heading">Enter OTP</h1>
            </div>
            <div class="modal-body pt-3 pb-3 text-center">
                <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                    <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                    <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                    <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                    <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                    <input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                    <input type="text" id="digit-6" name="digit-6" data-next="digit-7" data-previous="digit-5" />
                </form>
            </div>
            <button class="resend-btn">Resend OTP</button>
            <a class="submit-btn" href="#change-password-modal" class="" data-bs-toggle="modal"  role="button">Verify</a>
        </div>
    </div>
</div>

<!-- OTP MODAL -->

<!-- CHANGE PASSWORD MODAL -->

<div class="modal fade gen-modal" id="change-password-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="img-box mb-4">
                    <img src="{{asset('assetsfront/images/header-logo.png')}}">
                </div>
                <button class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <h1 class="heading">Change Password</h1>
            </div>
            <div class="modal-body p-0">
                <form action="">
                    <ul class="list-unstyled">
                        <li class="form-group">
                            <input type="password" placeholder="Existing Password">
                        </li>
                        <li class="form-group">
                            <input type="password" placeholder="New Password">
                        </li>
                        <li class="form-group">
                            <input type="password" placeholder="Confirm New Password">
                        </li>
                        <li class="form-group">
                            <button class="submit-btn">Update</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CHANGE PASSWORD MODAL -->








<script src="{{asset('assetsfront/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assetsfront/js/stellarnav.min.js')}}"></script>
<script src="{{asset('assetsfront/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assetsfront/js/jquery.fancybox.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/custom.js')}}"></script> 
<script src="{{asset('assetsfront/js/jquery.validate.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/additional-methods.min.js')}}"></script> 
<script src="{{asset('assetsfront/js/toastr.min.js')}}"></script> 

<script>
    // Login Screens Js
$( ".flip-card-btn-turn-to-front" ).click(function() {
    
    $("."+ $(this).data("card")).show();
    $(".flip-card").addClass( "do-flip" );
});

$('.flip-card-btn-turn-to-back').click(function(){
    $(".flip-card").removeClass( "do-flip" );
});

 
</script>
<script>
$(document).ready(function() {
    $('form[id="signupForm"]').validate({
        rules: {
            first_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            password_confirmation: {
                required: true,
                    equalTo: "#password"
                }
        },
        messages: {
            first_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            email: {
                required: "<span style='color:red'>This field is required</span>",
                email: "<span style='color:red'>Please enter a valid email address</span>",
            },
            password: {
                required: "<span style='color:red'>This field is required</span>",
            },
            password_confirmation: {
                required: "<span style='color:red'>This field is required</span>",
                equalTo: "<span style='color:red'>Enter Confirm Password Same as Password</span>",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('form[id="signinForm"]').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "<span style='color:red'>This field is required</span>",
                email: "<span style='color:red'>Please enter a valid email address</span>",
            },
            password: {
                required: "<span style='color:red'>This field is required</span>",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<script>
$(document).ready(function() {
    var type = "{{ Session::get('alert') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
});
</script>

</body>
</html>
