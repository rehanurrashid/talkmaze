<div class="col-md-2dot4 p-0 overflow-hidden" >
                    <div class="position-custom">
                        <div class="bg-main h-50 ">
                            <div class="text-center pt-3">
                                <a href="{{ url('/') }}"> <img src="{{ asset('images/logo white.png') }}" width="150"> </a>
                            </div>
                            <hr style="border-top: 2px solid white;">
                            <div class="text-center mt-1">
                                <center>
                                    <div style="width: 100px; height:100px; overflow: hidden; border-radius: 50%;" class="m-auto">
                                        <img src="{{ auth()->user()->profile->image }}" height="100%" style="object-fit: cover; object-position: center; width: 100%;">
                                    </div>
                                </center>
                                <a href="{{ url('dashboard-profile') }}" style="text-decoration: none;">
                                    <p class="text-white mt-2"style="font-size: 16px !important;" >{{ auth()->user()->name }}</p>
                                </a>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ url('dashboard-profile') }}" style="text-decoration: none;"> <img src="{{ asset('images/settings.png') }}"
                                        width="24"></a>
                            </div>
                            <div class="text-center">
                                @if(!auth()->user()->hasRole('coach'))
                                    @if(!auth()->user()->tutors()->where('is_group',0)->exists())
                                        <button class="btn default1 mt-4 mb-5" data-toggle="modal"
                                                data-target="#exampleModalCenter">Find Coach</button>
                                    @else
                                        <br/>
                                        <br/>
                                    @endif
                                @else
                                    <a href="{{ url('/student-request') }}" class="btn default1 mt-4 mb-5">Student Request</a>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 h-50" style="font-size: 17px !important;">
                            <a class="text-decoration-none" href="{{ url('dashboard-home') }}">
                                <div class="row p-0 m-0 hovBg  pt-2 justify-content-center  {{Request::is('dashboard-home') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">Home</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ url('dashboard-coaching') }}">
                                <div class="row hovBg p-0 m-0  pt-2 justify-content-center {{Request::is('dashboard-coaching') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="far fa-id-card"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">Coaching</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ route('my.course') }}">
                                <div class="row hovBg p-0 m-0 pt-2 justify-content-center {{Request::is('dashboard-my/courses') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="fas fa-suitcase"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1 ">My Resources</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ url('dashboard-post') }}">
                                <div class="row hovBg p-0 m-0  pt-2 justify-content-center {{Request::is('dashboard-post') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="far fa-copy"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">My Posts</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ url('dashboard-session') }}">
                                <div class="row hovBg p-0 m-0  pt-2 justify-content-center {{Request::is('dashboard-session') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">Session History</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ url('chat') }}">
                                <div class="row hovBg p-0 m-0  pt-2 justify-content-center {{Request::is('chat') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">Chats</h5>
                                    </div>

                                </div>
                            </a>
                            <a class="text-decoration-none" href="{{ url('dashboard-logout') }}">
                                <div class="row hovBg p-0 m-0  pt-2 justify-content-center position-custom1 {{Request::is('dashboard-login') ? 'active-option' : 'else'}}">
                                    <div class="col-2">
                                        <i class="fas fa-power-off"></i>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="pt-1 pb-1">Logout</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
