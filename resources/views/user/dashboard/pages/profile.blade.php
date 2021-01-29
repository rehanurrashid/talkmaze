@extends('user.dashboard.layouts.main')

@section('title', 'Profile')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-----------------------MAin Setion----------------------------->
    <section>
        <div class="container-fluid ">
            <div class="row">
                <!---------------------------------------------------------Colloum 1-------------------------------------------->
                @include('user.dashboard.partials.sidebar')
                <!-------------------------------------------------------------colloum2------------------------------------------->
                <div class="col-md-8dot4 bg-light">
                    <br/>
                    @if(Session::has('success'))
                        <div class="alert alert-primary" role="alert">
                            User Updated successfuly
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <!---------------------------------------------------------------------------------Login detail tab-->
                    <section>
                        <div class="container">
                            <div class="row justify-content-center " style="margin-top: 4rem;">
                                <div class="col-md-8">
                                    <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="text-center row justify-content-center">
                                        <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden;">
                                            <img src="{{ auth()->user()->profile->image }}" id="disimg" height="100%" style="width: 100%;; object-fit: cover; object-position: center;">
                                        </div>
                                        <div class="image-upload">
                                            <label for="file-input">
                                                <img class="img-position pointr" src="images/photo-camera.png"
                                                    width="30">
                                            </label>

                                            <input id="file-input" onchange="loadFile(event)" type="file" hidden name="photo" />
                                        </div>
                                        {!! $errors->first('photo', '<label id="photo-error" class="error" for="photo">:message</label>') !!}
                                        <p id="error1" style="display:none; color:#FF0000;">
                                            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                        </p>
                                        <p id="error2" style="display:none; color:#FF0000;">
                                            Maximum File Size Limit is 5MB.
                                        </p>
                                    </div>
                                </div>
                            </div>
                                <div id="1stnormal">
                                    <div class="row justify-content-center mt-4 ">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">First Name</label>
                                                <input type="text" class="form-control input-bg"
                                                    id="formGroupExampleInput"  placeholder="John" value="{{$user->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput5">Last Name</label>
                                                <input type="text" class="form-control input-bg"
                                                    id="formGroupExampleInput5"   placeholder="Doe" value="{{$user->last_name}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row justify-content-center ">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput2">Email</label>
                                                <input type="text" class="form-control input-bg"
                                                    id="formGroupExampleInput2"  placeholder="johnr@gmail.com"
                                                    value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput3">Password</label>
                                                    <input type="password" class="form-control input-bg"
                                                        id="formGroupExampleInput3" placeholder="*******"
                                                        value="{{$user->password}}">
                                                </div>

                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput3">Nickname</label>
                                                <input type="text" class="form-control input-bg"
                                                       id="formGroupExampleInput3" placeholder=""
                                                       value="{{$user->nick}}">
                                            </div>

                                        </div>
                                    </div>

                                    <!-- <div class="row justify-content-center ">
                                        <div class="col-md-4">
                                            <label for="formGroupExampleInput4">Gender</label>
                                            <select disabled  class="form-control input-bg ">
                                                <option >Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="formGroupExampleInput8">Role</label>
                                            <select disabled  class="form-control input-bg">
                                                <option>teacher</option>
                                                <option>student</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                <div id="1stupdate" style="display: none;">
                                    <div class="row justify-content-center mt-4 ">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">First Name</label>
                                                <input name="first_name" type="text" class="form-control input-bg"
                                                    id="formGroupExampleInput" placeholder="John" value="{{$user->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput5">Last Name</label>
                                                <input name="last_name" type="text" class="form-control input-bg"
                                                    id="formGroupExampleInput5" placeholder="Doe" value="{{$user->last_name}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row justify-content-center ">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput2">Email</label>
                                                <input type="text" class="form-control input-bg"
                                                   disabled id="formGroupExampleInput2"
                                                   placeholder="john@example.com" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label id="price11" for="formGroupExampleInput3">Password</label>
                                                <a class="text-decoration-none color-1" style="float:right" href="#" onclick="hideElement()" id="passlink">Change password</a>
                                                <input name="old" type="password" disabled class="form-control input-bg"
                                                    id="formGroupExampleInput11">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput4">Nickname</label>
                                                <input type="text" class="form-control input-bg"
                                                       id="formGroupExampleInput4" name="nick" placeholder="Nick name"
                                                       value="{{$user->nick}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div id="1stpass" style="display: none;">
                                        <div class="row justify-content-center ">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput9">New Password</label>
                                                    <input name="new" type="password" class="form-control input-bg"
                                                        id="formGroupExampleInput3">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput10">Confirm Password</label>
                                                    <input name="confirm" type="password" class="form-control input-bg"
                                                        id="formGroupExampleInput7">
                                                </div>
                                            </div>
                                        </div></div>

                                    <!-- <div class="row justify-content-center ">
                                        <div class="col-md-4">
                                            <label for="formGroupExampleInput4">Gender</label>
                                            <select class="form-control input-bg">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="formGroupExampleInput8">Role</label>
                                            <select class="form-control input-bg">
                                                <option>teacher</option>
                                                <option>student</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                        <button id="btn2" class="mt-5 mb-5 btn btn-lg btn-size center-btn"
                                        onclick=" hideElementZero()" type="submit" style="display: none;" >UPDATE</button>
                                </div>
                            </form>
                            <button id="btn1" class="mt-5 mb-5 btn btn-lg btn-size center-btn"
                                    onclick=" hideElementZero()">EDIT</button>
                            <br>
                            <br>
                            <br>
                        </div>
                    </section>




                </div>
            </div>
        </div>
    </section>

    <!-- image validate  -->
    <script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>

    <script>
        function hideElementZero() {
            document.getElementById('1stnormal').style.display = 'none';
            document.getElementById('1stupdate').style.display = 'block';
            document.getElementById('btn1').style.display = 'none';
            document.getElementById('btn2').style.display = 'block';


        }
        function hideElement() {
            document.getElementById('1stpass').style.display = 'block';
            document.getElementById('passlink').style.display = 'none';
            document.getElementById('price11').innerHTML = 'Old Password';
            document.getElementById('formGroupExampleInput11').disabled = false;




        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('dashboard/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

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

        var loadFile = function(event) {
            var image = document.getElementById('disimg');
            image.src  = 'https://www.jetroad.com.tw/v_comm/global/images/loading.gif'
            // image.src = URL.createObjectURL(event.target.files[0]);
            let form = new FormData;
            form.append('picture', $('input[type=file]')[0].files[0]);
            form.append('_token', '{{ csrf_token() }}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'{{ route('update.profile') }}',
                data:form,
                enctype: 'multipart/form-data',
                method:'POST',
                processData:false,
                contentType: false,
                cache: false,
                success:function(data){
                    image.src = data
                },
                error:function(error){
                    image.src = 'https://cdn2.iconfinder.com/data/icons/bitsies/128/Cancel-512.png'
                }
            })
        };

    </script>

@endsection
