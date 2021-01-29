@extends('user.dashboard.layouts.main')

@section('title', 'Home')

@section('content')
    <!-------------------------MAin Setion------------------------>
    <section>
        <div class="container-fluid ">
            <div class="row">
                <!---------------------------------------------------------Colloum 1-------------------------------------------->
            @include('user.dashboard.partials.sidebar')
                <!-------------------------------------------------------------colloum2------------------------------------------->
                <div class="col-md-8dot4">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-md-4">
                                <h3 class="color-1 mt-3 font-weight-normal">Dashboard</h3>
                                <h6 class="color-1">Welcome to the @if(auth()->user()->hasRole('coach')) Coaching @else Student @endif dashboard</h6>
                            </div>

                            <div class="col-md-8">
                                <div class="row mt-3 justify-content-end">
                                    <a href="#" class="mr-2" > <img onclick="myFunction()" class="mt-1 dropbtn " src="images/-e-notifications.png" width="30" height="30"></a>
                                    <form class="mr-3">
                                        <input class=" top-search-bar" type="text" name="search"
                                            placeholder="Search...">
                                    </form>
                                </div>
                            </div>
                            <!----------------------------notification dropdown-------------------->
                            <div id="myDropdown" class="dropdown-content dropdown-menu-right bg-white ">
                                <div class="container" >
                                    <!-- <div class="row  border-b">
                                        <div class="col-6 p-2">
                                            <div class="text-center color-1" id="notdul" onclick="hideElementZero()">
                                                <i class="far fa-bell"></i> <span class="ml-2 font-weight-bold"
                                                    style="font-size: 0.67em;"> Notification</h6>
                                            </div>
                                        </div>
                                        <div class="col-6 border-l p-2">
                                            <div class="text-center" id="reqdul" onclick="hideElement()">
                                                <i class="far fa-comment"></i> <span class="ml-2 font-weight-bold"
                                                    style="font-size: 0.67em;"> Request</h6>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div id="1stmodal">
                                    <div   style="height:60vh; width:100%;" class="scroll-f mt-3 mb-3" >
                                        <div class="container-fluid" >
                                        <div class="row mt-1" >
                                            <div class="col-3">
                                                <img class="mt-3" src="images/msgpic.png" width="50">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="mt-2">John Doe</h5>
                                                <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet consecte</h6>
                                                <h6 class="h7 color-1">3 days</h6>
                                            </div>
                                        </div>
                                        <div class="row mt-1 border-g">
                                            <div class="col-3">
                                                <img class="mt-3" src="images/msgpic1.png" width="50">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="mt-2">John Doe</h5>
                                                <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet consecte</h6>
                                                <h6 class="h7 color-1">3 days</h6>
                                            </div>
                                        </div>
                                        <div class="row mt-1 border-g">
                                            <div class="col-3">
                                                <img class="mt-3" src="images/msgpic1.png" width="50">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="mt-2">John Doe</h5>
                                                <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet consecte</h6>
                                                <h6 class="h7 color-1">3 days</h6>
                                            </div>
                                        </div>
                                        <div class="row mt-1 border-g">
                                            <div class="col-3">
                                                <img class="mt-3" src="images/msgpic.png" width="50">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="mt-2">John Doe</h5>
                                                <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet consecte</h6>
                                                <h6 class="h7 color-1">3 days</h6>
                                            </div>
                                        </div>
                                        <div class="row mt-1 border-g">
                                            <div class="col-3">
                                                <img class="mt-3" src="images/msgpic1.png" width="50">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="mt-2">John Doe</h5>
                                                <h6>Lorem ipsum dolor sit amet consecte <br>dolor sit amet consecte</h6>
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
                        <div class="row mt-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <a href="{{ url('/dashboard-session') }}" class="text-decoration-none">
                                        <div class="card shadow-card">
                                            <div class="card-body">
                                                <h1 class="text-center color-1">@if(auth()->user()->hasRole('coach')) {{ auth()->user()->tutor_session()->count() }}  @else {{ auth()->user()->student_session()->count() }} @endif</h1>
                                                <h5 class="text-center color-1">Sessions Attended</h5>
                                                <img class="center-btn mt-3" src="images/-e-coaching.png" width="50">

                                            </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <a href="{{ url('/dashboard-coaching') }}" class="text-decoration-none">
                                        <div class="card shadow-card">
                                            <div class="card-body">
                                                <h1 class="text-center color-1">@if(auth()->user()->hasRole('coach')) {{ auth()->user()->host()->count() }}  @else {{ auth()->user()->enrollments()->count() }} @endif</h1>
                                                <h5 class="text-center color-1">Upcoming Sessions</h5>
                                                <img class="center-btn mt-3" src="images/-e-coaching.png" width="50">

                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <a href="resorces.html" class="text-decoration-none">
                                        <div class="card shadow-card">
                                            <div class="card-body">
                                                <h1 class="text-center color-1">{{ auth()->user()->courses()->count() }}</h1>
                                                <h5 class="text-center color-1">My Resources</h5>
                                                <img class="center-btn mt-3" src="images/-e-coaching.png" width="50">

                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <a href="post.html" class="text-decoration-none">
                                        <div class="card shadow-card">
                                            <div class="card-body">
                                                <h1 class="text-center color-1">{{ auth()->user()->debates()->count() }}</h1>
                                                <h5 class="text-center color-1">My Posts</h5>
                                                <img class="center-btn mt-3" src="images/-e-coaching.png" width="50">

                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-------------------------------------------------calender--------------------->
                        <div class="row mt-4 mb-5">
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
                                                @if($scheduals)
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
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="card shadow-card">
                                    <div class="card-body ">
                                        <div class="row " style="padding-top: 1rem;">
                                            <div class="col-12 scroll-f" >
                                                <h3 >News Feeds</h3>
                                                @foreach($debates as $deb)
                                        <div class="row mt-2">
                                            <h4 class="font-weight-bold ml-3">{{ $deb->user->name }}</h4>
                                            <h6 class="ml-3 mt-1 text-muted">{{ $deb->created_at->diffForHumans() }}</h6>
                                        </div>
                                                <div class="row">
                                                    <h5 class="ml-3 mr-2 font-weight-normal">{{ $deb->topic }}
                                                    </h5>
                                                </div>
                                                <div class="row">
                                                    <a class="ml-3 link-card" href="{{ url('/forum-detail/'.$deb->slug) }}" target="_blank">View detail</a>
                                                </div>
                                        <hr>
                                                @endforeach

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
    </section>

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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('dashboard/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <!--steps-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
    <script>
        $(document).ready(function () {
            $("#form-total-t-1").click(function () {
                // alert("The paragraph was clicked.");
                $("div.actions").children().css('display', "inline-block");
            });

            // $('a[href^="#finish"]').click(function () {
            //     $("#form-total").hide();
            //     $("#lastmodal").show();
            // });
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
    //]]>
        //// end
    </script>
    @if(session('success'))
        <script>
            $.toast({
                text: "Congratulations! You have successfully requested for a Tutor. We weill contacting you soon", // Text that is to be shown in the toast
                heading: 'Congratulations!', // Optional heading to be shown on the toast
                icon: 'success', // Type of toast icon
                showHideTransition: 'fade', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 10000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9EC600',  // Background color of the toast loader
                beforeShow: function () {}, // will be triggered before the toast is shown
                afterShown: function () {}, // will be triggered after the toat has been shown
                beforeHide: function () {}, // will be triggered before the toast gets hidden
                afterHidden: function () {}  // will be triggered after the toast has been hidden
            });
        </script>
    @endif

@endsection
