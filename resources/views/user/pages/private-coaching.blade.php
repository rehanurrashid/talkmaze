
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
                        <h2 class="text-uppercase" style="font-size: 32px;">PERSONALIZED COACHING</h2>
                        <h4 class="text-capitalize mt-2" style="font-size: 20px;">Online Instruction for All Skill Levels</h4>
                        <button onclick="location.href='{{ url('register') }}'" class="btn-dark mt-3">REGISTER NOW</button>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class=" text-center">
                        <img class="img-fluid mt-5 mb-5" src="images/private 1ldpi.png" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing-steps-sec hero-section-price">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="shape">
                        <h3 class="sh-1 text-capitalize text-white">
                            <span class="one">1</span><br>
                            <span class="tell" style="margin-left: 1rem;">Tell us</span><br>
                            <span class="about">about</span><br>
                            <span class="yours" style="margin-left: 2rem;">yourself</span>
                        </h3>
                    </div>
                </div>
                <div class="col-md-8">
                    <p class="shape-txt">
                        Your unique skill level and needs are our priority. To personalize your sessions, we need to know a little bit about you!
                    </p>
                </div>
            </div>
            <!------------------ row ---------------------------->
            <div class="row">
                <div class="col-md-8">
                    <p class="shape-txt">
                        All of our plans include regular coaching because we know the importance of consistency in developing key skills.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="shape-1">
                        <h3 class="sh-2 text-capitalize text-white">
                            <span style="margin-left: 6rem; font-size: 48px;">2</span><br><br>
                            <span>Select a</span><br>
                            <span class="ml-5">Plan that</span><br>
                            <span>works</span>
                        </h3>
                    </div>
                </div>
            </div>
            <!------------------ row ---------------------------->
            <div class="row">
                <div class="col-md-4">
                    <div class="shape-2">
                        <h3 class="sh-3 text-capitalize text-white">
                            <span style="font-size: 48px;">3</span><br>
                            <span class="get" style="margin-left:2rem;" >Get Matched</span><br>
                            <span class="witha">With a</span><br>
                            <span class="coac" style="margin-left:4rem;" >Coach</span>
                        </h3>
                    </div>
                </div>
                <div class="col-md-8">
                    <p class="shape-txt">
                        Simple as that! Within minutes, you’ll be able to schedule your initial session with your coach and begin your life changing journey.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing packages-sec mt-4" id="price-table">
        <h2 class="text-center text-uppercase mb-5 pt-3">Plans</h2>
        <div class="container mt-5 mt-5">
            <div class="row">

                <!-- Free Tier -->
                @foreach ($plans as $plan)
                    <div class="col-lg-4 mt-5">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h6 class="card-price text-center shadow-lg">
                                    {{ $plan->name }}
                                </h6>
                                <h3 class="text-center color-a mt-2 mb-2">{{ $plan->duration }}</h3>
                                <div class="pricingTable-header mt-3 mb-3">
                                    <div class="price-value text-right">${{ $plan->price }}</div>
                                </div>
                                <div class="mt-5 mb-5">
                                    @php
                                        $data = explode(PHP_EOL,$plan->description)
                                    @endphp
                                    <h5>
                                        @foreach($data as $rf)
                                            <li>{{ $rf }}</li>
                                        @endforeach
                                    </h5>
                                </div>

                                <div class="text-center " style="margin-top: 5rem;">
                                    @if(Auth::check())
                                        @if(auth()->user()->package && auth()->user()->package->plan_id == $plan->id)
                                            <span class="text-muted">Already Subscribed</span>
                                        @else
                                            <button onclick="changevar({{ $plan->id }})" href="#" data-toggle="modal" data-target="#exampleModal" class="btn-dark text-uppercase" style="padding: 12px 32px;">Select</button>
                                        @endif
                                    @else
                                        <button onclick="changevar({{ $plan->id }})" href="#" data-toggle="modal" data-target="#loginModal" class="btn-dark text-uppercase" style="padding: 12px 32px;">Select</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="ment-txt mt-5">
                    <h3>Add on up to 3 friends to your sessions!</h3>
                    <li style="font-size: 20px;">2 people = 10% off for both</li>
                    <li style="font-size: 20px;">3 people = 15% off for all</li>
                    <li style="font-size: 20px;">4 people = 20% off for all</li>
                </div>
            </div>
            <div class="col-md-4">
                <img class="w-100" src="images/money-illustration-png-3.png">
            </div>
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
