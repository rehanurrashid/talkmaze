@extends('user.dashboard.layouts.main')

@section('title', 'Student Requests')

@section('content')
    <!------------------------MAin Setion------------------------->
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
                                            src="images/calender (2).png" width="64%"></span>
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

                        @foreach($stuts as $st)
                            <div class="row mt-5">
                            <div class="container">
                                <div class="bg-white shadow-card" style="border-radius: 14px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div style="height: 120px; overflow: hidden;">
                                                <img src="{{ $st->student->profile->image }}" width="100%" height="100%" style="object-fit: cover;">
                                            </div>

                                        </div>
                                        <div class="col-md-2 p-4">
                                            <h4 class="text-center font-weight-bold mt-2">{{ $st->student->name }}</h4>
                                            <h6 class="text-center">public speaker</h6>
                                        </div>
{{--                                        <div class="col-md-3 p-2">--}}
{{--                                            <h4 class="text-center font-weight-bold mt-2">Availabality Days</h4>--}}
{{--                                            <h6 class="text-center">Monday</h6>--}}
{{--                                            <h6 class="text-center">Tuesday</h6>--}}
{{--                                            <h6 class="text-center">Wednesday</h6>--}}
{{--                                        </div>--}}
                                        <div class="col p-4">
                                            <div class="text-center mt-3" style="font-size: 12px;">
                                                <span class="fa-star {{ ($st->student->rating->avg('rating') >= 1) ? 'fas':'far' }}" ></span>
                                                <span class="fa-star {{ ($st->student->rating->avg('rating') >= 2) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($st->student->rating->avg('rating') >= 3) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($st->student->rating->avg('rating') >= 4) ? 'fas':'far' }}"></span>
                                                <span class="fa-star {{ ($st->student->rating->avg('rating') >= 5) ? 'fas':'far' }}"></span>
                                                <span>{{ floor($st->student->rating->avg('rating')) }}.0</span>
                                                <br>
                                                <span>{{ $st->student->rating->count() }} People Rated</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <div class="text-center mt-def">
                                                <button onclick="updayteid({{$st->id}})" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                                    Accept
                                                </button>
                                                <a href="/" class="btn default4"> Reject</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

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
        var modelid = 0
        function updayteid(id) {
            modelid = id
        }

    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="movealong(modelid)">Accept</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function movealong(modelid) {
            window.location.replace('{{ url('request/accept/') }}/'+ modelid)
        }
    </script>
@endsection
