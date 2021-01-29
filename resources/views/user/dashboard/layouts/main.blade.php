<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/dist/css/pignose.calendar.min.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/steps.css')}}" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!--<link href="{{asset('dashboard/css/fm.selectator.jquery.css')}}" rel="stylesheet">-->
    <!--<link href="{{ asset('admin/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">-->
    <!--<link href="{{ asset('admin/css/layout.min.css') }}" rel="stylesheet" type="text/css">-->
    <!--<link href="{{ asset('admin/css/components.min.css') }}" rel="stylesheet" type="text/css">-->
<!--{{--    <link href="{{ asset('admin/css/colors.min.css') }}" rel="stylesheet" type="text/css">--}}-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <title>Coaching</title>
</head>

<body>

  @yield('content')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <style>
            .bootstrap-select {
                width:100%!important;
            }
        </style>
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
                                      <input value="{{ csrf_token() }}" hidden type="text" id="csrf">

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
                                                  <textarea class="form-control" id="message-text1"
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

                                                      <h5 class="text-center  text-muted" for="exampleCheck1"
                                                          style="font-size: 16px;">Do you have access to a webcam
                                                          and mic for coaching sessions?</h5>

                                                  </div>
                                              </div>
                                          </div>

                                      </div>
                                  </section>

                              </div>
                          </div>
                          <div id="lastmodal" style="display: none;">
                              <div class="text-center">
                                  <img class="mt-1" src="{{ asset('images/tick mark.png') }}">
                              </div>
                              <h5 class="text-center text-muted mt-4" style="font-size: 16px;">You are almost
                                  done!</h5>
                              <div class="text-center">
                                  <a id="gotopay" class="btn default3 mt-5 mb-4">Select payment plan</a>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>

          </div>

      </div>
  </div>
</div>

</body>
</html>
