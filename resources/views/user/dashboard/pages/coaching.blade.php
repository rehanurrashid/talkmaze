@extends('user.dashboard.layouts.main')

@section('title', 'Post')

@section('content')
    <!---------------------MAin Setion-------------->
    <section>
        <div class="container-fluid ">
            <div class="row">

                <!-------------Colloum 1------------------------>
                @include('user.dashboard.partials.sidebar')

                <!-----------------------------colloum2------------------->
                @if(auth()->user()->tutors->count() >0 || auth()->user()->hasRole('coach') || auth()->user()->enrollments->count() >0)
                    <div class="col-md-8dot4 bg-light">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-md-4">
                                <h3 class="color-1 mt-3 font-weight-normal">Dashboard</h3>
                                <h6 class="color-1">Welcome to the @if(auth()->user()->hasRole('coach')) Coaching @else Student @endif dashboard</h6>

                            </div>

                            <div class="col-md-8">
                                <div class="row mt-3 justify-content-end mr-5">
                                    <a href="#"> <img onclick="myFunction()" class="mt-1 dropbtn "
                                            src="images/-e-notifications.png" width="30" height="30"></a>
                                    <form>
                                        <input class="margin-search top-search-bar" type="text" name="search"
                                            placeholder="Search...">
                                    </form>
                                </div>
                            </div>
                            <!----------------------------notification dropdown-------------------->
                            <div id="myDropdown" class="dropdown-content dropdown-menu-right bg-white ">
                                <div class="container">
                                    <div id="1stmodal">
                                        <div style="height:60vh; width:100%;" class="scroll-f mt-3 mb-3">
                                            <div class="container-fluid">
                                                <div class="row mt-1">
                                                    <div class="col-3">
                                                        <img class="mt-3" src="images/msgpic.png" width="50">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="mt-2">John Doe</h5>
                                                        <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet
                                                            consecte</h6>
                                                        <h6 class="h7 color-1">3 days</h6>
                                                    </div>
                                                </div>
                                                <div class="row mt-1 border-g">
                                                    <div class="col-3">
                                                        <img class="mt-3" src="images/msgpic1.png" width="50">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="mt-2">John Doe</h5>
                                                        <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet
                                                            consecte</h6>
                                                        <h6 class="h7 color-1">3 days</h6>
                                                    </div>
                                                </div>
                                                <div class="row mt-1 border-g">
                                                    <div class="col-3">
                                                        <img class="mt-3" src="images/msgpic1.png" width="50">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="mt-2">John Doe</h5>
                                                        <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet
                                                            consecte</h6>
                                                        <h6 class="h7 color-1">3 days</h6>
                                                    </div>
                                                </div>
                                                <div class="row mt-1 border-g">
                                                    <div class="col-3">
                                                        <img class="mt-3" src="images/msgpic.png" width="50">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="mt-2">John Doe</h5>
                                                        <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet
                                                            consecte</h6>
                                                        <h6 class="h7 color-1">3 days</h6>
                                                    </div>
                                                </div>
                                                <div class="row mt-1 border-g">
                                                    <div class="col-3">
                                                        <img class="mt-3" src="images/msgpic1.png" width="50">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="mt-2">John Doe</h5>
                                                        <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet
                                                            consecte</h6>
                                                        <h6 class="h7 color-1">3 days</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <!--------------------------------------------------------------1st card-------------------------->
                        <!--slider-->
                        <section>
                            <div class="center slider pt-2 pb-2 ">
                                @if(auth()->user()->hasRole('user'))
                                    @foreach($sessions as $sc)
                                    <div>
                                        <div class="card shadow-card" style="@if($sc->pivot->status == 1) {{ 'color: white !important; background-color: #69d2b1;' }} @endif">
                                            <div class="text-center">
                                                <div class="card-body">
                                                    <h5 class="text-right text-white" style="float: right;">@if($sc->pivot->status == 1) {{ 'Live' }} @endif</h5>
                                                    <center>
                                                        <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                                            <img style="object-position: center; object-fit: cover; width: 100%;" height="100%;" width="100%" src="{{$sc->profile->image}}">
                                                        </div>
                                                    </center>
                                                    <h3 class=" mt-3">{{ $sc->name }}</h3>
                                                    <h5 class=" text-muted mt-3" style="@if($sc->pivot->status == 1) {{ 'color: white !important;' }} @endif">Session Time : {{ date('H:i:s', strtotime($sc->pivot->ended_at) - strtotime($sc->pivot->created_at)) }}
                                                    </h5>
                                                    <h5 class=" text-muted" style="@if($sc->pivot->status == 1) {{ 'color: white !important;' }} @endif">{{ $sc->pivot->created_at->diffForHumans() }}</h5>
                                                    <h5 class=" text-muted" style="@if($sc->pivot->status == 1) {{ 'color: white !important;' }} @endif">{{ date('d M Y',strtotime($sc->pivot->created_at) ) }}</h5>
                                                    <a class=" color-1" href="#" style="text-decoration: none; @if($sc->pivot->status == 1) {{ 'color: white !important;' }} @endif" >View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    @foreach($scheduals as $sc)
                                        <div>
                                            <div class="card shadow-card">
                                                <div class="text-center">
                                                    <div class="card-body">
                                                        <h5 class="text-right text-white" style="float: right;"></h5>
                                                        <center>
                                                            <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                                                <img style="object-position: center; object-fit: cover; width: 100%;" height="100%;" width="100%" src="{{$sc->image}}">
                                                            </div>
                                                        </center>
                                                        <h3 class=" mt-3">{{ $sc->name }}</h3>
                                                        <h5 class=" text-muted mt-3">Session Date & Time <br/> {{ date('Y-m-d H:i:s', strtotime($sc->date_time)) }}
                                                        </h5>
                                                        <h5 class=" text-muted" >{{ \Carbon\Carbon::createFromDate($sc->date_time)->diffForHumans() }}</h5>
                                                        @if(\Carbon\Carbon::parse($sc->date_time) <= \Carbon\Carbon::now())<a class=" color-1" href="{{ route('start.meeting',['id'=>$sc->id]) }}" style="text-decoration: none;" >Start Session</a>@endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </section>
                        <!-------------------------------------------------calender--------------------->
                        <div class="row mt-4 mb-5 justify-content-center">
                            <div class="col-md-8 mt-3">
                                <div class="card shadow-card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <div>
                                                    <div id="basic" class="article">
                                                        <div class="calendar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 scroll-f">
                                                @forelse($scheduals as $scr)
                                                    <div>
                                                        <h5 class="mt-2">{{ date('d-M-Y',strtotime($scr->date_time)) }} <span class="ml-4 text-muted"
                                                                                                style="font-size: 12px;">{{ date('H:i a',strtotime($scr->date_time)) }}</span></h5>
                                                        <h6 class="text-muted">{{ $scr->title }}</h6>
                                                    </div>
                                                    <hr>
                                                @empty
                                                    not found
                                                @endforelse

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->hasRole('user') && $coach)

                                <div class="col-md-4 mt-3">
                                    <div class="card shadow-card">
                                        <div class="card-body">
                                            <h3 class=" font-weight-bold text-center">Profile</h3>
                                            <div class="text-center">
                                                <br/>
                                                <div style="width: 100px; height: 100px; border-radius: 10px; overflow: hidden;" class="m-auto">
                                                    <img style="object-position: center; object-fit: cover;" width="100%" src="{{ $coach->profile->image }}">
                                                </div>
                                                <h3 class=" mt-3">{{ $coach->name }}</h3>
                                                <h4 class="text-muted">Effective speech in <br> larger audience</h4>
                                                <h5 class="font-weight-bold">{{ $coach->profile->city }}, {{ $coach->profile->country }}</h5>
                                                @if($session)
                                                    @if($session->is_group)
                                                        <a href="{{ route('call.group.caller',['id'=>$session->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                    @else
                                                        <a href="{{ route('call.caller',['id'=>$session->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('call.caller',['id'=>$coach->pivot->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                @endif

                                                    {{--                                                <a href="{{ route('call.end',['id'=>$session->room_id]) }}" class="btn default3 mt-4 mb-5">Start Session</a>--}}
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                            @elseif(auth()->user()->hasRole('coach'))
                                <style>
                                    .green{
                                        background-color: #69d2b1;
                                    }
                                </style>
                                <div class="col-md-4 mt-3">
                                    <div class="row p-0 m-0">
                                        <div class="card shadow-card w-100">

                                            <div class="card-body">
                                                <h3 class="text-muted">Initialize a Session</h3>
                                                <div class=" d-flex align-items-center">
                                                    <button type="button" class="m-2 btn green text-white" style="" data-toggle="modal" data-target="#exampleModal">
                                                        Start a Group Call
                                                    </button>
                                                    <button type="button" class="m-2 btn green text-white" data-toggle="modal" data-target="#exampleModal2">
                                                        Schedule a Session
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($session)
                                    <div class="row p-0 m-0 mt-4">
                                        <div class="card shadow-card w-100">
                                            <div class="card-body">
                                                <h3 class="text-muted">You Have Session Running</h3>
                                                <div class="d-flex justify-content-center" style="flex-direction: row;">
                                                    @if($session)
                                                        @if($session->is_group)
                                                            <a href="{{ route('call.group.caller',['id'=>$session->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                        @else
                                                            <a href="{{ route('call.caller',['id'=>$session->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('call.caller',['id'=>$session->room_id]) }}" target="_blank" @if($running) style="background-color: #1a7c00;" @endif class="btn default3 mt-4 mb-5">@if($running) Join Session @else Start Session @endif</a>
                                                    @endif
                                                            <a href="{{ route('end.session',['id'=>$session->room_id]) }}" @if($running) style="background-color: red; margin: 5px;" @endif class="btn default3 mt-4 mb-5">@if($running) End Session @else Start Session @endif</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                    <div class="col" style="height: 100vh;">
                        <div class="row h-100 justify-content-center flex">
                            <div class="col-auto align-self-center">
                                <div class="row justify-content-center p-3">
                                    <center><h2>You do not have any coaches. Let’s get started!</h2></center>
                                </div>
                                <br/>
                                <div class="row justify-content-center">
                                    <img src="https://d5qtswyw90myf.cloudfront.net/images/male-tutor.png" width="40%">
                                </div>
                                <br/><br/>
                                <div class="row justify-content-center">
                                    <button class="btn default1 mt-4 mb-5 px-5 py-3" style="background-color: #69d2b1 !important; color: white !important;" data-toggle="modal" data-target="#exampleModalCenter">
                                        <strong>Get Started</strong>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content  w-75 ml-5" style="border-radius: 25px;">
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class=" form-register" action="#" method="post">
                                    <div id="form-total">
                                        <!-- SECTION 1 -->
                                        <h1></h1>
                                        <section>
                                            <div class="row justify-content-center mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="text-center  text-muted" style="font-size: 16px;">Why
                                                        would you like to be matched with a coach?</h5>
                                                    <div class="form-group mt-3">
                                                        <textarea class="form-control" id="message-text"
                                                            style="background-color:#ccc;"> </textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </section>
                                        <!-- SECTION 2 -->
                                        <h1></h1>
                                        <section>
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 mt-3">
                                                    <h5 class="text-center  text-muted" style="font-size: 16px;">Do you
                                                        have any experience with public speaking or debate? If so, please
                                                        explain.</h5>
                                                    <div class="form-group mt-3">
                                                        <textarea class="form-control" id="message-text"
                                                            style="background-color:#ccc;"> </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>
                                        <!-- SECTION 3 -->
                                        <h1></h1>
                                        <section>
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group mt-3 mb-5">
                                                        <div >
                                                            <h5 class="text-center  text-muted"
                                                                style="font-size: 16px;">Do you have access to a webcam
                                                                and mic for coaching sessions?</h5>
                                                            <input value="{{ csrf_token() }}" hidden type="text" id="csrf">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>

                                    </div>
                                </div>
                                <div id="lastmodal" style="display: none;">
                                    <div class="text-center">
                                        <img class="mt-1" src="images/tick mark.png">
                                    </div>
                                    <h5 class="text-center text-muted mt-4" style="font-size: 16px;">You are almost
                                        done!</h5>
                                    <div class="text-center">
                                        <a href="/coaching#price-table" class="btn default3 mt-5 mb-4">Select payment plan</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Create Group</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.group') }}" method="POST">
                <div class="modal-body">
                    @if($students)
                            @csrf
                            <select class="selectpicker" multiple data-live-search="true" style="width:100%;">
                                @foreach($students as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Go</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Schedule a Meeting</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.schedual') }}" method="POST" id="form">
                    <div class="modal-body">
                        @if($students)
                            @csrf
                        <p class="text-muted m-0 p-0">Add Students(s)</p>
                            <select class="selectpicker" multiple data-live-search="true">
                                @foreach($students as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                        @endif
                        <div class="row p-0 m-0 mt-2">
                            <input type="text" name="title" class="form-control" placeholder="Add Title">
                        </div>
                        <div class="row p-0 m-0 mt-2">
                            <textarea type="text" name="description" class="form-control" placeholder="Add Description"></textarea>
                        </div>
                        <div class="row p-0 m-0 mt-2">
                            <input type="datetime-local" name="date_time" class="form-control" placeholder="Add Description">

                        </div>
                            <div class="row p-0 m-0 mt-2">
                                <select name="is_group" class="form-control">
                                    <option value="1">Private session</option>
                                    <option value="2">Group session</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-----------------------drop down script--------------------------->
    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        document.getElementById("myDropdown").addEventListener('click', function (event) {
            event.stopPropagation();
        });
    </script>
    <!-------------------------------tab script-------------->
    <!--script carousal slider-->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{asset('dashboard/slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function () {
            
            $('#id_select').selectpicker();
            $('#id_selectt').selectpicker();

            $(".center").slick({
                dots: false,
                infinite: true,
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 2,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: false,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 0,
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

        });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="js/jquery-3.3.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="{{ asset('dashboard/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script src="{{ asset('dashboard/js/fm.selectator.jquery.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo_pages/form_select2.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!--steps-->
    <script>
        $(document).ready(function () {


            $("#form-total-t-1").click(function () {
                // alert("The paragraph was clicked.");
                $("div.actions").children().css('display', "inline-block");
            });

            $('a[href^="#finish"]').click(function () {
                $("#form-total").hide();
                $("#lastmodal").show();
            });
        })

    </script>
    <!--calender-->
    <script type="text/javascript" src="{{ asset('dashboard/dist/js/pignose.calendar.full.min.js') }}"></script>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

            function onSelectHandler(date, context) {
                /**
                 * @date is an array which be included dates(clicked date at first index)
                 * @context is an object which stored calendar interal data.
                 * @context.calendar is a root element reference.
                 * @context.calendar is a calendar element reference.
                 * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
                 * @context.storage.events is all events associated to this date
                 */

                var $element = context.element;
                var $calendar = context.calendar;
                var $box = $element.siblings('.box').show();
                var text = 'You selected date ';

                if (date[0] !== null) {
                    text += date[0].format('YYYY-MM-DD');
                }

                if (date[0] !== null && date[1] !== null) {
                    text += ' ~ ';
                }
                else if (date[0] === null && date[1] == null) {
                    text += 'nothing';
                }

                if (date[1] !== null) {
                    text += date[1].format('YYYY-MM-DD');
                }

                $box.text(text);
            }

            function onApplyHandler(date, context) {
                /**
                 * @date is an array which be included dates(clicked date at first index)
                 * @context is an object which stored calendar interal data.
                 * @context.calendar is a root element reference.
                 * @context.calendar is a calendar element reference.
                 * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
                 * @context.storage.events is all events associated to this date
                 */

                var $element = context.element;
                var $calendar = context.calendar;
                var $box = $element.siblings('.box').show();
                var text = 'You applied date ';

                if (date[0] !== null) {
                    text += date[0].format('YYYY-MM-DD');
                }

                if (date[0] !== null && date[1] !== null) {
                    text += ' ~ ';
                }
                else if (date[0] === null && date[1] == null) {
                    text += 'nothing';
                }

                if (date[1] !== null) {
                    text += date[1].format('YYYY-MM-DD');
                }

                $box.text(text);
            }

            // Default Calendar
            $('.calendar').pignoseCalendar({
                select: onSelectHandler
            });

            // This use for DEMO page tab component.
            $('.menu .item').tab();
        });
        </script>
@endsection
