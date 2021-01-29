
@extends('user.layouts.main')

@section('title', 'Plans')

@section('content')
<!----------------------Nav Bar---------------------------->
@include('user.partials.navbar')
<script>
    var plan_id = 0;
    var packg = '';
    function changevar(id) {
        plan_id = id
        if(id === 1){
            packg = 'P-9GK03533AU437713LL2IWHYA';
        }else if(id === 2){
            packg = 'P-0YM58809KR8868934L2IZQRI';
        }else if(id === 3){
            packg = 'P-1YW725332U087481JL2IZSKA';
        }
    }
</script>

    <section class="hero-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 m-auto">
            <div class="text-center text-justify">
                <h2 class="text-uppercase" style="font-size: 32px;">PROFESSIONAL COACHING</h2>
            <h4 class="text-capitalize mt-2" style="font-size: 20px;">Debate. MUN. Public Speaking. We're experts at it all.</h4>
            <button onclick="location.href='{{ url('register') }}'" class="btn-dark mt-3">REGISTER NOW</button>
            </div>
          </div>
          <div class=" col-md-6">
            <div class=" text-center">
              <img class="img-fluid mt-5 mb-5" src="images/coaching art.png" width="370">
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="debate-speaking-sectiom">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 m-auto p-5">
                        <div class="text-center">
                            <img class="img-fluid"  src="images/group 2ldpi.png" width="100%">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 m-auto" style="display: flex; justify-content: center;">
                        <div class="tips-text text-center m-0 w-100">
                            <h2 class="text-uppercase" style="font-size: 32px;">GROUP COACHING</h2>
                            <h4 class="text-capitalize mt-2" style="font-size: 20px;">Curriculum based, Live</h4>
                            <h4 class="text-capitalize mt-2" style="font-size: 20px;">and interactive courses</h4>
                            <h4 class="text-capitalize mt-2" style="font-size: 20px;"> with experienced coaches</h4>
                            <button onclick="location.href='{{ url('group-coaching') }}'" class="btn-dark mt-3">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="debate-speaking-sectiom">
        <div class="speaking-backround py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 m-auto" style="display: flex; justify-content: center;">
                        <div class="tips-text text-center m-0 w-100">
                            <h2 class="text-uppercase" style="font-size: 32px;">PRIVATE COACHING</h2>
                            <h4 class="text-capitalize mt-2" style="font-size: 20px;">personalized coaching for</h4>
                            <h4 class="text-capitalize mt-2" style="font-size: 20px;">small groups and individuals</h4>
                            <button onclick="location.href='{{ url('private-coaching') }}'" class="btn-dark mt-3">Learn More</button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 m-auto">
                        <div class="text-center">
                            <img class="img-fluid "  src="images/private 2ldpi.png" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mentor-sec">
   <h1 class="text-center text-uppercase mt-5 mb-5">Looking for mentorship for your school or team?</h1>
   <div class="container">
     <div class="row">
       <div class="col-md-8">
         <div class="ment-txt mt-5">
           <h3>Here's what we offer!</h3>
           <li style="font-size: 20px;">Live online classes, workshops, and seminars</li>
           <li style="font-size: 20px;">Mentorship for new and experienced debate clubs</li>
           <li style="font-size: 20px;">Access to exclusive resources for teams</li>
         </div>
       </div>
       <div class="col-md-4">
         <img class="w-100" src="images/illust.png">
       </div>
     </div>
   </div>
  </section>
    <section >
    <div class="container mt-2" id="contact-us" >
      <div class="text-left">
        <h2>Reachout to us</h2>
      </div>
      <form method="post" action="{{ route('guest.coaching_bulk') }}" class="js-form">
        @csrf
        <div class="row mt-4">
          <div class="col-md-6">
            <label class="font-weight-bold">First name</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="John" type="text" name="first_name" value="{{old('first_name')}}" data-validate-field="first_name">
            {!! $errors->first('first_name', '<label id="first-name-error" class="text-danger" for="first_name">:message</label>') !!}
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">Last name</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="Doe" type="text" name="last_name" value="{{old('last_name')}}" data-validate-field="last_name">
            {!! $errors->first('last_name', '<label id="last-name-error" class="text-danger" for="last_name">:message</label>') !!}
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-6">
            <label class="font-weight-bold">Email</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="johndoe@gmail.com" type="email" name="email" value="{{old('email')}}" data-validate-field="email">
            {!! $errors->first('email', '<label id="email-error" class="text-danger" for="email">:message</label>') !!}
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">Phone No</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="Enter your phone number" type="tel" name="phone" value="{{old('phone')}}" data-validate-field="phone">
            {!! $errors->first('phone', '<label id="email-error" class="text-danger" for="email">:message</label>') !!}
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-6">
            <label class="font-weight-bold">Team/School/Organization Name</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="Enter your organization/school" type="text" name="organization" value="{{old('organization')}}" data-validate-field="organization">
            {!! $errors->first('organization', '<label id="organization-error" class="text-danger" for="organization">:message</label>') !!}
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">Your Role</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="Teacher" type="text" name="role" value="{{old('role')}}" data-validate-field="role">
            {!! $errors->first('role', '<label id="role-error" class="text-danger" for="role">:message</label>') !!}
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-6">
            <label class="font-weight-bold">Country</label><span class="text-danger">*</span>
            <input class="form-control bg-light" placeholder="Enter your country" type="text" name="country" value="{{old('country')}}" data-validate-field="country">
            {!! $errors->first('country', '<label id="country-error" class="text-danger" for="country">:message</label>') !!}
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">City <sub>(optional)</sub> </label>
            <input class="form-control bg-light" placeholder="Teacher" type="text" name="city" value="{{old('city')}}" >
            {!! $errors->first('city', '<label id="city-error" class="text-danger" for="city">:message</label>') !!}
          </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-12 ">
          <label for="message" class="font-weight-bold">What kind of help you are hoping to get?</label><span class="text-danger">*</span>
          <textarea class="form-control bg-light" placeholder="please write here.." rows="5" id="message" data-validate-field="message" name="message">{{old('message')}}</textarea>
          {!! $errors->first('message', '<label id="message-error" class="text-danger" for="message">:message</label>') !!}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class=" mb-5 mt-3">
            <button type="submit" class=" btn btn-dark">Contact</button>
          </div>
        </div>
      </div>
      </form>


    </div>
  </section>
    <!-- Modal for Sucessfully Sent Request -->
    <div class="modal fade" id="exampleModalRequestSent" tabindex="-1" role="dialog"
    aria-labelledby="ModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content p-3" style="width: 80%; margin-left: auto; margin-right:auto; display: block;">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title ml-auto text-dark" id="exampleModalLongTitle" >
            <strong>Your Request Successfully Sent!</strong>
          </h4>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
    <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Activate Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @auth
                    <script
                        src="https://www.paypal.com/sdk/js?client-id=Ae8ae0kv9usFSI1PC4ll408ixIizDsoWJo13fRN0nkZsqtaet-cOCCUXLzpBxUsiVJKFiq4DekG8cdoj&vault=true">
                    </script>

                    <div id="paypal-button-container"></div>

                    <script>
                        paypal.Buttons({
                            createSubscription: function(data, actions) {
                                return actions.subscription.create({
                                    'plan_id': packg
                                });
                            },
                            onApprove: function(data, actions) {
                                alert('You have successfully created subscription ' + data.subscriptionID);
                                $.ajax({
                                    url:'{{ route('update.plan') }}',
                                    method:'POST',
                                    data:{
                                        from:'{{ $from }}',
                                        data_id:'{{ $data_id }}',
                                        plan:plan_id,
                                        _token:'{{ csrf_token() }}'
                                    },
                                    success:function (data) {
                                        window.location.replace(data.url)
                                    },
                                    error:function (error) {

                                    }
                                })
                            }
                        }).render('#paypal-button-container');

                    </script>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- Modal For pop Up sign in -->
    <div class="modal fade p-0 " id="loginModal" tabindex="-1" role="dialog"
    aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content p-3" style="width: 80%; margin-left: auto; margin-right:auto; display: block;">
        <div class="modal-header">
          <h4 class="modal-title ml-auto" id="exampleModalLongTitle">Log In</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('guest.login') }}" class="js-form-login form">
          @csrf
            <label class="text-muted h8 font-weight-bolder">Email/Username</label><span class="text-danger">*</span>
            <input class="form-control bg-light" type="email" name="email"  style="height: 2.2rem;" value="{{old('email')}}" id="email" data-validate-field="email"
            >
            {!! $errors->first('email', '<label id="email-error-default" style="color:#D75A4A" for="email">:message</label>') !!}
            <label id="email-error" for="email" class="d-none" style="color:#D75A4A">Email is required!</label>
            <label id="email-error-valid" for="valid-email" class="d-none" style="color:#D75A4A">Please enter a valid Email Address!</label>

            <label class="text-muted h8 font-weight-bold mt-2">Password</label><span class="text-danger">*</span>
            <input class="form-control bg-light" type="password" name="password" style="height: 2.2rem;" id="password" data-validate-field="password" >
            {!! $errors->first('password', '<label id="password-error-default" style="color:#D75A4A" for="password">:message</label>') !!}
            <label id="password-error" for="password" class="d-none" style="color:#D75A4A">Password is required!</label>

            <button id="btn-default-login" type="submit" class="btn btn-default-login mt-4">SEND</button>

            <a href="{{url('register')}}">
              <h6 class="text-center mt-2 color-a" style="font-size: 0.8em;">Create new account</h6>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
<!----------------------Footer ---------------------------->
@include('user.partials.footer')

<!----------------------Copyright---------------------------->
@include('user.partials.copyright')

  <script src="{{ asset('js/just-validate.min.js') }}"></script>
  <script>

    $(document).ready(function(){

      @if(Session::has('message'))
        $('#exampleModalRequestSent').modal('show');
      @elseif($errors->get('email') || $errors->get('password'))
        $('#loginModal').modal('show');
      @endif

    })

    new window.JustValidate('.js-form', {
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            phone : {
                required: true,
            },
            organization : {
                required: true,
            },
            role : {
                required: true,
            },
            country: {
              required: true,
            },
            message: {
              required: true,
            },

        },
        messages: {

            first_name: {
              required: 'First Name is required',
            },
            last_name: {
              required: 'Last Name is required',
            },
            email: {
              required: 'Email address is required',
            },
            role: {
              required: 'Role is required',
            },
            phone: {
              required: 'Phone number is required',
            },
            organization: {
              required: 'Organization is required',
            },
            country: {
              required: 'Country is required',
            },
            message: {
              required: 'Message is required',
            },
        },
    });
</script>
@endsection
