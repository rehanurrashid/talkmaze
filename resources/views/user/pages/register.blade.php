@extends('user.layouts.main')

@section('title', 'Register')

@section('content')

  <body style="background-image: url(./images/bg.png); background-repeat: no-repeat; background-size: cover; ">
    <section class="login-page">
      <div class="container">
        <a href="{{ url('home') }}"><img class="mt-5 mb-5 logo-login" src="images/logo.png"></a>
        <div class="row  mb-4">
          <div class="col-md-6 order-2 order-sm-1">
            <div class="card shadow-lg rounded m-auto" >
                <div class="card-body">
                    <h3 class="font-weight-bold mb-2">Get Started</h3>
                    <div class="inner3">&nbsp;</div>
             <a href="{{ url('login') }}"><h6 class="mt-2 color-a " >Already have an Account?</h6></a>
              <form method="POST" action="{{ route('guest.register') }}" class="js-form form">
                @csrf
                  <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="text-muted h8" >First Name</label>
                        <input class="form-control bg-light" type="text" name="fname"  style="height: 2.2rem;" data-validate-field="fname" value="{{old('fname')}}">
                        {!! $errors->first('fname', '<label id="fname-error" class="text-danger" for="fname">:message</label>') !!}
                      </div>
                      <div class="col-md-6">
                        <label class="text-muted h8" >Last Name</label>
                        <input class="form-control bg-light" type="text" name="lname"  style="height: 2.2rem;" data-validate-field="lname" value="{{old('lname')}}">
                        {!! $errors->first('lname', '<label id="lname-error" class="text-danger" for="lname">:message</label>') !!}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <label class="text-muted h8" >Email</label>
                      <input class="form-control bg-light" type="text" name="email"  style="height: 2.2rem;" data-validate-field="email" value="{{old('email')}}">
                      {!! $errors->first('email', '<label id="email-error" class="text-danger" for="email">:message</label>') !!}
                    </div>
                    <div class="col-md-6">
                      <label class="text-muted h8" >Confirm Email</label>
                      <input class="form-control bg-light" type="text" name="email_confirmation"  style="height: 2.2rem;" value="{{old('email_confirmation')}}">
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                      <label class="text-muted h8" >Password</label>
                      <input class="form-control bg-light" type="password" name="password"  style="height: 2.2rem;" data-validate-field="password" id="password">
                      {!! $errors->first('password', '<label id="password-error" class="text-danger" for="password">:message</label>') !!}
                    </div>
                    <div class="col-md-6">
                      <label class="text-muted h8" >Confirm Password</label>
                      <input class="form-control bg-light" type="password" name="password_confirmation"  style="height: 2.2rem;" data-validate-field="password_confirmation">
                  </div>
                </div>
                  <div class="row mt-2">
                      <div class="col-md-6">
                          <label class="text-muted h8" >City</label>
                          <input class="form-control bg-light" type="text" name="city"  style="height: 2.2rem;" data-validate-field="city" id="city">
                          {!! $errors->first('city', '<label id="city-error" class="text-danger" for="city">:message</label>') !!}
                      </div>
                      <div class="col-md-6">
                          <label class="text-muted h8" >Country</label>
                          <input class="form-control bg-light" type="text" name="country"  style="height: 2.2rem;" data-validate-field="country">
                      </div>
                  </div>
                <div class="row">
                  <div class="form-check  ml-3 mt-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tos" data-validate-field="tos" >
                    <label class="form-check-label" for="exampleCheck1">I accept <a href="#" style="text-decoration: underline;" data-toggle="modal" data-target="#exampleModalCenterOne">terms and conditions</a> </label>
                   {!! $errors->first('tos', '<label id="tos-error" class="text-danger" for="tos">:message</label>') !!}
                  </div>
                </div>
                <button type="submit"  class="btn btn-default-login mt-3 text-uppercase">Register</button>
              </form>
                </div>
              </div>
          </div>
          <div class="col-md-6  order-1 order-sm-2 m-auto">
            <div >
              <img class="ml-auto mb-5 mt-2"  src="images/get-started-img.png" width="100%">
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- Modal For pop Up sign in -->
  <div class="modal fade" id="exampleModalCenterOne" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterOneTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-3" style=" margin-left: auto; margin-right:auto; display: block;">
      <div class="modal-header">
        <h4 class="modal-title ml-auto" id="exampleModalLongTitle">Terms And Conditions</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem aperiam perferendis, ducimus aliquid ipsa illum mollitia eveniet rem, quisquam quam, placeat consequatur culpa magnam quae? Et corrupti esse dolore inventore.</h5>
      </div>
    </div>
  </div>
</div>

  <script src="{{ asset('js/just-validate.min.js') }}"></script>
  <script>
    new window.JustValidate('.js-form', {
        rules: {
            tos: {
                required: true
            },
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            city:{
                required:true
            },
            country:{
                required:true
            },
            email: {
                required: true,
                email: true,
            },
            password : {
                strength: {
                default: true,

              },
            },
            password_confirmation: {
              equalTo: "#password"
            },

        },
        messages: {
            login: {
                remote: 'Login already exists',
            },
            fname: {
              required: 'First Name is required',
            },
            lname: {
              required: 'Last Name is required',
            },
            tos: {
              required: 'You must be agree with our terms & conditions',
            },
            city: {
                required: 'City Name is required',
            },
            country: {
                required: 'Country Name is required',
            }
        },
    });
</script>
</body>

@endsection
