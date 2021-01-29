@extends('user.dashboard.layouts.main')

@section('title', 'Tutor List')

@section('content')
    <!----------------------------MAin Setion------------------------>
    <section>
        <div class="container-fluid ">
            <div class="row">
                <!---------------------------------------------------------Colloum 1-------------------------------------------->
                @include('user.dashboard.partials.sidebar')
                <!-------------------------------------------------------------colloum2------------------------------------------->
                <div class="col-md-8dot4">
                    <div class="container-fluid mt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="row mt-3 bg-white shadow-card mr-2 border-curve">
                                    <h6 class=" ml-3 custom-font">Available on</h6>
                                    <span style="display: block; margin-left:auto;"><img class="p-1"
                                            src="{{ asset('images/calender (2).png') }}" width="64%"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row mt-3 ">
                                    <select class="form-control shadow-card border-curve" >
                                        <option>Public Speaking</option>
                                        <option>student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row mt-3 ">
                                    <form>
                                        <input class="margin-search top-search-bar3" type="text" name="search"
                                            placeholder="Search..." style="width: 100%;" >
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container ">
                        <br/>
                        <!--------------------------------------------------------------1st card-------------------------->
                        @foreach($tuts as $tut)
                        <div class="row mt-3">
                            <div class="container">
                                <div class="bg-white shadow-card" style="border-radius: 14px; overflow: hidden;">
                                    <div class="row p-0">
                                        <div class="col-md-2">
                                            <div style="height: 120px; overflow: hidden;">
                                                <img src="{{ $tut->profile->image }}" width="100%" height="100%" style="object-fit: cover;">
                                            </div>

                                        </div>
                                        <div class="col-md-2 p-4">
                                            <h4 class="text-center font-weight-bold mt-2">{{ $tut->name }}</h4>
                                            <h6 class="text-center">public speaker</h6>
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <h4 class="text-center font-weight-bold mt-2">Availabality Days</h4>
                                            @if($tut->timetable->count()>0)
                                                @foreach($tut->timetable as $days)
                                                    <h6 class="text-center">{{ $days->day->name }}</h6>
                                                @endforeach
                                            @else
                                                <h6 class="text-center text-muted font-weight-bold">No Specific Days</h6>
                                            @endif

                                        </div>
                                        <div class="col-md-2 p-4">
                                            <div class="text-center mt-3" style="font-size: 12px;">
                                                <span class="fa-star {{ ($tut->rating->avg('rating') >= 1) ? 'fas':'far' }}" ></span>
                                                <span class="fa-star {{ ($tut->rating->avg('rating') >= 2) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($tut->rating->avg('rating') >= 3) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($tut->rating->avg('rating') >= 4) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($tut->rating->avg('rating') >= 5) ? 'fas':'far' }}"></span>
                                                <span>{{ floor($tut->rating->avg('rating')) }}.0</span>
                                                <br>
                                                <span>{{ $tut->rating_count }} People Rated</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-2">
                                            <div class="text-center mt-def">
                                                <a href="{{ route('send.tutor.request',['tutor_id'=>$tut->id,'request_id'=>$id]) }}" class="btn default3">Request Tutor</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        <br/>

                        <!---------------------------------------------------------------------------------Login detail tab-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.steps.js')}}"></script>
    <script src="{{asset('dashboard/js/main.js')}}"></script>
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

@endsection
