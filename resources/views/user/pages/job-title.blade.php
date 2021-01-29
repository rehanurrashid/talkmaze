@extends('user.layouts.main')

@section('title', 'Job Title')

@section('content')
<!----------------------Nav Bar---------------------------->
@include('user.partials.navbar') 

  <section>
    <div class="container">
        <div id="1stnormal">
          <div class="row">
            <div class="col-md-12">
              <div class="text-center ">
              <h4 class="text-dark text-uppercase pb-2 mt-5">
              {{ $job->title}}
              </h4>
              <div class="inner">&nbsp;</div>
            </div>
            </div>
          </div>
          <form method="POST" action="{{ route('applicant.register') }}" class="js-form form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="job_id" value="{{ $job->id }}">
          <div class="row justify-content-center mt-5 ">
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold" for="formGroupExampleInput">First Name</label>
                <input class="form-control input-bg" type="text" name="fname"  style="height: 2.2rem;" data-validate-field="fname" value="{{old('fname')}}" placeholder="Jhon">
                {!! $errors->first('fname', '<label id="fname-error" class="text-danger" for="fname">:message</label>') !!}
                <p id="fname" class="mt-1 ml-1" style="display:none; color:#B81111;">
                   First Name is required!
                </p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold" for="formGroupExampleInput1">Last Name</label>
                <input class="form-control input-bg" type="text" name="lname"  style="height: 2.2rem;"  value="{{old('lname')}}" placeholder="Doe">
                {!! $errors->first('lname', '<label id="lname-error" class="text-danger" for="lname">:message</label>') !!}
                <p id="lname" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Last Name is required!
                </p>
              </div>

            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold" for="formGroupExampleInput2">Email</label>
                <input class="form-control input-bg" type="text" name="email"  style="height: 2.2rem;"  value="{{old('email')}}" placeholder="johnr@gmail.com">
                {!! $errors->first('email', '<label id="email-error" class="text-danger" for="email">:message</label>') !!}
                <p id="email" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Email is required!
                </p>
                <p id="email-valid" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Please enter a valid email address!
                </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold" for="formGroupExampleInput4">Phone No.</label>
                <input class="form-control input-bg" type="tel" name="phone"  style="height: 2.2rem;"  value="{{old('phone')}}" placeholder="111-222-3333">
                {!! $errors->first('phone', '<label id="phone-error" class="text-danger" for="phone">:message</label>') !!}
                <p id="phone" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Phone number is required!
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold" for="formGroupExampleInput5">Education Level</label>
                <input class="form-control input-bg" type="text" name="education"  style="height: 2.2rem;"  value="{{old('education')}}" placeholder="PHD">
                {!! $errors->first('education', '<label id="education-error" class="text-danger" for="education">:message</label>') !!}
                <p id="education" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Education is required!
                </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mt-4">
                <label class="font-weight-bold" for="formGroupExampleInput6">Gender</label>&nbsp;
                <label class="radio-inline ml-3">
                  <input type="radio" name="gender" data-validate-field="gender" checked>&nbsp;Male
                </label>
                <label class="radio-inline ml-2">
                  <input type="radio" name="gender" data-validate-field="gender">&nbsp;Female
                </label>
                <label class="radio-inline ml-2">
                  <input type="radio" name="gender" data-validate-field="gender">&nbsp;Other
                </label>
                {!! $errors->first('gender', '<label id="gender-error" class="text-danger" for="gender">:message</label>') !!}
              </div>
            </div>

          </div>
          <div class="row justify-content-center ">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlTextarea1">Debate and /or Public Speaking</label>
                <textarea class="form-control input-bg-box" id="exampleFormControlTextarea1" rows="3"
                  placeholder="Please write here..." name="debate" >{{ old('debate') }}</textarea>
                  {!! $errors->first('debate', '<label id="debate-error" class="text-danger" for="debate">:message</label>') !!}
                  <p id="debate" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Debate and /or Public Speaking is required!
                </p>
              </div>

            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlTextarea2">Coaching and Teaching Experience(does not have to be)</label>
                <textarea class="form-control input-bg-box" id="exampleFormControlTextarea2" rows="3"
                  placeholder="Describe yourself here..." name="experience" >{{ old('experience') }}</textarea>
                  {!! $errors->first('experience', '<label id="experience-error" class="text-danger" for="experience">:message</label>') !!}
                  <p id="experience" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Experience is required!
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlTextarea3">Why would like to become a debate coach with Talkmaze?</label>
                <textarea class="form-control input-bg-box" id="exampleFormControlTextarea3" rows="3"
                  placeholder="Please write here..." name="why_to_join" >{{ old('why_to_join') }}</textarea>
                  {!! $errors->first('why_to_join', '<label id="why_to_join-error" class="text-danger" for="why_to_join">:message</label>') !!}
                  <p id="why_to_join" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  Why would like to become a debate coach with Talkmaze is required!
                </p>
              </div>

            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlTextarea4">What do you hope to gain out of your experience? (optional)</label>
                <textarea class="form-control input-bg-box" id="exampleFormControlTextarea4" rows="3"
                  placeholder="Please write here..." name="expect_outcome_of_your_experience" data-validate-field="expect_outcome_of_your_experience">{{ old('expect_outcome_of_your_experience') }}</textarea>
                  {!! $errors->first('expect_outcome_of_your_experience', '<label id="expect_outcome_of_your_experience-error" class="text-danger" for="expect_outcome_of_your_experience">:message</label>') !!}
              </div>

            </div>
          </div>
          <!--file attachment-->
          <div class="row justify-content-center ">
            <div class="col-md-3">
              <div class="image-upload text-center">
                <label for="file-input2">
                  <div>
                    <h4 class="mt-4">Reference (attachment-optional)</h4>
                    <h6>Formate: PDF ,Max File Size: 5MB</h6>
                    <i class="fas fa-upload pointer"></i> <span class="pointer"
                      style="font-size: 18px; font-weight: 600;">Upload</span>
                  </div>
                </label>
                <input type="file" name="reference" id="file-input2"  />
                {!! $errors->first('reference', '<label id="reference-error" class="text-danger" for="reference">:message</label>') !!}
                <p id="reference-error1" style="display:none; color:#B81111;">
                  Invalid File Format! File Format Must Be PDF.
                </p>
                <p id="reference-error2" style="display:none; color:#B81111;">
                   Maximum File Size Limit is 5MB.
                </p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="image-upload text-center">
                <label for="file-input1">
                  <div>
                    <h4 class="mt-4">Resume (attachment)</h4>
                    <h6>Formate: PDF ,Max File Size: 5MB</h6>
                    <i class="fas fa-upload pointer"></i> <span class="pointer"
                      style="font-size: 18px; font-weight: 600;">Upload</span>
                  </div>
                </label>
                <input id="file-input1" type="file" name="resume"/>
                {!! $errors->first('resume', '<label id="resume-error" class="text-danger" for="resume">:message</label>') !!}
                <p id="error1" style="display:none; color:#B81111;">
                  Invalid File Format! File Format Must Be PDF.
                </p>
                <p id="error2" style="display:none; color:#B81111;">
                   Maximum File Size Limit is 5MB.
                </p>
                <p id="resume-required" style="display:none; color:#B81111;">
                   Resume is required
                </p>
              </div>
            </div>
          </div>
          <!--accordian-->
          <div class="row justify-content-center mt-3 ">
            <div class="col-md-8 ">
              <div id="accordion" class="accordion">
                <div class="card">
                    <div class="card-header collapsed input-bg-box" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" 
                    style="box-shadow: 0 6px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 14px 0 rgba(0, 0, 0, 0.19);" onclick=" hideElementZero()">
                        <a class="card-title">
                         How many hours per week are you able to commit?<span id="plus" class="float-right" style="display: block;"><i
                          class="fas fa-plus"></i></span><span id="minus" class="float-right" style="display: none;"><i
                            class="fas fa-minus"></i></span> 
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse input-bg-box" data-parent="#accordion" >
                        <div class="container-fluid pb-2">
                          <div class="row mt-3">
                            <div class="col-md-6">
                             <h5> Days</h5>
                            </div>
                            <div class="col-4 col-md-2 text-center"><h5> Time zone</h5> </div>
                            <div class="col-4 col-md-2 text-center"><h5>From</h5></div>
                            <div class="col-4 col-md-2 text-center"><h5>To</h5></div>
                          </div>
                        @foreach($days as $day)
                          <div class="row mt-2">
                            <div class="col-md-6">
                              <div class="form-check  mt-2">
                                <input type="checkbox" class="form-check-input checkbox" value="{{ $day->id }}" id="checkbox{{$day->id}}" name="day" data-validate-field="day">
                                <label class="form-check-label text-uppercase" for="exampleCheck1">
                                {{ $day->name }}
                                </label>
                              </div>
                            </div>
                            <div class="col-4 col-md-2">
                              <select class="form-control input-bg-select select2 time_zone false" name="day[{{$day->id}}][time_zone]" disabled >
                                <option>GMT+5</option>
                                <option>GMT+6</option>
                              </select>
                            </div>
                            <div class="col-4 col-md-2">
                              <select class="form-control input-bg-select select2 from false" name="day[{{$day->id}}][from]" disabled>
                                <option>9 AM</option>
                                <option>01 PM</option>
                              </select>
                            </div>
                            <div class="col-4 col-md-2">
                              <select class="form-control input-bg-select select2 to false" name="day[{{$day->id}}][to]" disabled>
                                <option>01 PM</option>
                                <option>09 AM</option>
                              </select>
                            </div>
                          </div>
                        @endforeach
                        </div>
                        </div>
                    </div>
                </div>
                <p id="timetable" style="display: none; color:#B81111;" class="mt-2">
                  At least one day should be selected! Click on plus button to expand Timetable.
                </p>
            </div>
            
          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="general_availabality">What is your general availabality
                  like? (optional)</label>
                <textarea class="form-control input-bg-box"  rows="3"
                  placeholder="Please write here..." name="general_availabality" data-validate-field="general_availabality">{{ old('general_availabality') }}</textarea>
                  {!! $errors->first('general_availabality', '<label id="general_availabality-error" class="text-danger" for="general_availabality">:message</label>') !!}
              </div>
            </div>
          </div>
          <!--radio button-->
          <div class="row justify-content-center mt-3">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold">Do you want to allow webcam/microphone?</label>
                <br>
                  <input type="hidden" class="form-check-input"  name="allow_device" value="yes">
                  <input type="hidden" class="form-check-input"  name="allow_device" value="no">
                {!! $errors->first('allow_device', '<label id="allow_device-error" class="text-danger" for="allow_device">:message</label>') !!}
                <p id="allow-device-required" style="display:none; color:#B81111;">
                   You have to check devices
                </p>
                <span class="ml-2" style="font-size: 14px; font-style: italic !important;cursor: pointer;"> <a class="text-dark" id="check_devices"><u>Check
                      Devices</u></a></span>
                <span id="allowed" class="d-none"><i class="fa fa-check fa-2x text-success ml-2" aria-hidden="true" ></i>Allowed</span>
                <span id="not-allowed" class="d-none"><i class="fa fa-times fa-2x text-danger ml-2" aria-hidden="true"removeClass></i>&nbsp; Not allowed</span>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-md-8">
              <div class="form-group">
                <label class="font-weight-bold" for="how_here_about_us">How did you here about us?</label>
                <textarea class="form-control input-bg-box" rows="3"
                  placeholder="Please write here..." name="how_here_about_us">{{ old('how_here_about_us') }}</textarea>
                  {!! $errors->first('how_here_about_us', '<label id="how_here_about_us-error" class="error" for="how_here_about_us">:message</label>') !!}
                  <p id="how_here_about_us" class="mt-1 ml-1" style="display:none; color:#B81111;">
                  How did you here about us is required!
                </p>
              </div>

            </div>
          </div>
          <!--button-->
          <div class="row justify-content-center">
            <div class="col-md-8">
              <button type="submit" class="btn btn-form text-uppercase mt-4 ">Submit</button>

            </div>
          </div>
          </form>
        </div>
    </div>
  </section>

<!----------------------Footer ---------------------------->
@include('user.partials.footer')

<!----------------------Copyright---------------------------->
@include('user.partials.copyright')

<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/myvalidate.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/applicant_validate.js') }}"></script>

@endsection