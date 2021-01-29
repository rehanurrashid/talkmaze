@extends('user.layouts.main')

@section('title', 'Home')

@section('content')
    <!------------------Top Section---------------------------->
    @include('user.partials.topbar')
    <!----------------------Nav Bar---------------------------->
    @include('user.partials.navbar')
    <!--  -->
    <section class="hero-section">
        <div class="container text-center">
            <div class="row" style="margin-right: 0px!important;">
                <div class="col-lg-5 col-md-5 text-justify m-auto">
                    <div class=" text-center">
                        <h1 class="mt-2"> Debate. Deliver.<br>Conquer. </h1>
                        <a href="{{ url('register') }}"><button type="button" class="btn btn-dark mt-4">Become a member</button></a>
                        <div class="register-text text-center mt-3 ">
                            Register for free!
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 m-auto">
                    <div class="hub-img">
                        <img class="img-fluid " src="images/pic1.png" width="460">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="personel-coaching-section">
        <div class="container">
            <div class="personalized-coaching mt-5">
                <img class="img-fluid" src="images/personalized-coaching.png">
                <div class="personalized-coaching-text text-center">
                    <h2 class="couching">Professional Coaching</h2>
                    <p class="comfort">Training for all skill levels in debate, public speaking, and MUN</p>
                    <a href="{{ url('coaching') }}"><button type="button" class="btn btn-dark">Learn more</button></a><br><br><br><br>
                </div>
            </div>
        </div>
    </section>
    <section class="debate-speaking-sectiom">
        <div class="speaking-backround py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 m-auto">
                        <div class="text-center">
                            <img class="img-fluid "  src="images/resourcespic.png">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 m-auto">
                        <div class="tips-text text-center">
                            <h1>Access resources for individual or group practice</h1><br>
                            <a href="{{ url('resources') }}"><button type="button" class="btn btn-dark">Resources</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="opinion-section mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 m-auto">
                    <div class="opinion-text text-center m-auto">
                        <h1 class=" text-capitalize h1">Share your opinion</h1><br>
                        <a href="{{ url('forum') }}"> <button type="button" class="btn btn-dark">Go to Forum</button></a>
                    </div><br>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="text-center">
                        <img  alt="opinion" src="images/opinion.png" width="300">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="tips-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <img class="ml-5" src="images/monthlytips.png" width="250">
                    </div>
                    <div class="col-md-5 m-auto">
                        <div class=" text-center">
                            <h1 >Get monthly speaking tips!</h1>
                            <form class="example mt-5 margin-resp js-form" action="{{ route('guest.subscribe') }}" style="margin:auto;max-width:350px" method="post">
                                @csrf
                                <input type="email" placeholder="your email address..." name="email" data-validate-field="email" id="email" required="required">
                                <button type="submit">SEND</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="more-reason-section">
        <div class="container">
            <div class="more-text text-center mt-5 mb-5 text-capitalize">
                <h1>More reasons to choose TalkMaze</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="images/network.png">
                        <h4 class="text-uppercase text-center mt-4 mb-4 color-a">Network</h4>
                        <p>Connect with a community of passionate debaters and speakers from across the world.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="images/useanywhere.png">
                        <h4 class="text-uppercase text-center mt-4 mb-4 color-a">ACCESSIBILITY</h4>
                        <p>Use the site from anywhere at anytime. All you need is an internet connection!</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="images/profassional.png" width="173">
                        <h4 class="text-uppercase mt-4 mb-4 color-a">PROFESSIONALISM</h4>
                        <p>We thoroughly vet each team member to ensure you are getting top quality services.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a href="{{ url('partner') }}"> <button class="btn-dark mt-3 mb-5">become a member</button></a>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="testimonial-section">
        <div class="testi-bg py-5">
            <h1 class="text-center text-capitalize mt-5 ">what users say about us</h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($testimonials as $testimonial)

                        <div class="carousel-item {{ ($loop->iteration == 1) ? 'active' : '' }} ">
                            <div class="container mb-5 p-5">
                                <div class="row container-fluid m-0">
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            <div style="width:100px; height:100px; border-radius:50%; overflow:hidden;" class="m-auto">
                                                <img class="" src="{{ $testimonial->image }}" height="100%">
                                            </div>
                                            <h3 class=" mt-4 mb-4"> {{ $testimonial->name }} </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class=" text-center testimo-text">
                                            {{ $testimonial->feedback }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="speaker-section container-fluid ">
        <div class="container mt-5">
            <h1 class="text-center" style="font-size: 2.8rem;">Are you an experienced speaker or debater?</h1>
            <div class="row mt-5 mb-5 justify-content-center">
                <div class="col-md-3 mb-1">
                    <div class="passion speaker-bt bg-passion">Share your passion</div>
                </div>
                <img class="rotate90 mt-4" src="images/arrow.png" width="50" height="40">
                <div class="col-md-3 mb-1">
                    <div class="passion speaker-bt-1 bg-passion">competitive wage</div>
                </div>
                <img class="rotate90 mt-4" src="images/arrow.png" width="50" height="40">

                <div class="col-md-3">
                    <div class="passion speaker-bt-2 bg-passion">flexible schedule</div>
                </div>
            </div>
            <p class="text-center">
                <a href="{{ url('join-team') }}"> <button class="btn-dark mt-1">Join our team</button></a>
            </p>
        </div>
    </section>

    <!-- Modal For pop Up Vote Required Before Comment -->
    <div class="modal fade" id="exampleModalRequestSent" tabindex="-1" role="dialog"
         aria-labelledby="ModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content p-3" style="width: 80%; margin-left: auto; margin-right:auto; display: block;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title ml-auto text-dark" id="exampleModalLongTitle" >
                        <strong>Please check your email to confirm subscription.</strong>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For pop Up Vote Required Before Comment -->
    <div class="modal fade" id="exampleModalRequestNotSent" tabindex="-1" role="dialog"
         aria-labelledby="ModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content p-3" style="width: 80%; margin-left: auto; margin-right:auto; display: block;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title ml-auto text-dark" id="exampleModalLongTitle" >
                        <strong>You are already subscribe to our website.</strong>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!----------------------Footer ---------------------------->
    @include('user.partials.footer')

    <!----------------------Copyright---------------------------->

    @include('user.partials.copyright')
    <script type="text/javascript">

        $(document).ready(function(){

            @if(Session::has('message'))
            $('#exampleModalRequestSent').modal('show');
            @endif

            @if(Session::has('exist'))
            $('#exampleModalRequestNotSent').modal('show');
            @endif

        })
        // validate subscribe email

        $('form.example').on('submit', function(e){

            // validation code here
            let email = $.trim($("input[name='email']").val());

            if(email != ''){

                var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

                var emailFormat = re.test($("#email").val());// this return result in boolean type

                if (!emailFormat) {
                    // alert('jskdak')
                    e.preventDefault();
                }
            }
            else{
                e.preventDefault();
            }
        });

    </script>

@endsection
