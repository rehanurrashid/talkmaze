@extends('user.dashboard.layouts.main')

@section('title', 'Resources')

@section('content')
    <!--------------------------MAin Setion---------------->
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
                                <div class="row mt-3 justify-content-end mr-5">
                                    <a href="#"> <img onclick="myFunction()" class="mt-1 dropbtn "
                                                      src="{{ asset('images/-e-notifications.png') }}" width="30" height="30"></a>
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
                                                        <img class="mt-3" src="{{ asset('images/msgpic.png') }}" width="50">
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
                                                        <img class="mt-3" src="{{ asset('images/msgpic1.png') }}" width="50">
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
                                                        <img class="mt-3" src="{{ asset('images/msgpic1.png') }}" width="50">
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
                                                        <img class="mt-3" src="{{ asset('images/msgpic.png') }}" width="50">
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
                                                        <img class="mt-3" src="{{ asset('images/msgpic1.png') }}" width="50">
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
                        <br/>
                        <h2 class="text-muted">People To chat with</h2>
                        <br>
                        @forelse($data as $dat)
                            <div class="bg-white shadow-card" style="border-radius: 14px; overflow: hidden; margin: 20px;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="height: 120px; overflow: hidden;">
                                            <img src="{{ $dat->profile->image }}" width="100%" height="100%" style="object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col p-2 m-auto">
                                        {{ $dat->name }}
                                    </div>
                                    <div class="col p-2">
                                        <div class="text-right mt-def mr-5">
                                            <a href="{{ route('chat',['id'=>$dat->id]) }}" class="btn btn-success">
                                                Chat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex align-items-center justify-content-center" style="height:70vh;">
                                <h3 class="text-muted">You Do Not Have Any Connections!</h3>
                            </div>
                        @endforelse
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
    {{--    <!-------------------------------tab script-------------->--}}
    {{--    <script>--}}
    {{--        function hideElementZero() {--}}
    {{--            document.getElementById('1stmodal').style.display = 'block';--}}
    {{--            document.getElementById('2ndmodal').style.display = 'none';--}}
    {{--            document.getElementById("notdul").style.color = '#69d2b1';--}}
    {{--            document.getElementById("reqdul").style.color = 'black';--}}
    {{--        }--}}
    {{--        function hideElement() {--}}
    {{--            document.getElementById('1stmodal').style.display = 'none';--}}
    {{--            document.getElementById('2ndmodal').style.display = 'block';--}}
    {{--            document.getElementById("notdul").style.color = 'black';--}}
    {{--            document.getElementById("reqdul").style.color = '#69d2b1';--}}
    {{--        }--}}
    {{--    </script>--}}
    {{--    <!----hide show of button-->--}}
    {{--    <script>--}}
    {{--        var toggle = document.getElementById("toggle");--}}
    {{--        var content = document.getElementById("content");--}}

    {{--        toggle.addEventListener("click", function () {--}}
    {{--            content.style.display = (content.dataset.toggled ^= 1) ? "block" : "none";--}}
    {{--        });--}}


    {{--    </script>--}}
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

    {{--    <!--steps-->--}}
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $("#form-total-t-1").click(function () {--}}
    {{--                // alert("The paragraph was clicked.");--}}
    {{--                $("div.actions").children().css('display', "inline-block");--}}
    {{--            });--}}

    {{--            $('a[href^="#finish"]').click(function () {--}}
    {{--                $("#form-total").hide();--}}
    {{--                $("#lastmodal").show();--}}
    {{--            });--}}
    {{--        })--}}

    {{--    </script>--}}

@endsection
