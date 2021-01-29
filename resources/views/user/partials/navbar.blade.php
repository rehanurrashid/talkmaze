<!----------------------Nav Bar---------------------------->
<section class="nav-section sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- <div class="row"> -->
        <div class="col-lg-3 col-sm-12 p-0">
          <a class="navbar-brand" href="{{ url('home') }}">
            <img class="main-logo" src="{{asset('images/logo.png')}}">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
              </button>
        </div>
        <div class="col-lg-9 col-sm-12 p-0">
          <div class="collapse navbar-collapse float-right" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item {{Request::is('home') ? 'active' : 'else'}}">
                <a class="nav-link" href="{{ url('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{Request::is('forum') ? 'active' : 'else'}}">
                      <a class="nav-link" href="{{ url('forum') }}">Forum</a>
                    </li>
                    <li class="nav-item {{Request::is('resources') ? 'active' : 'else'}}">
                      <a class="nav-link" href="{{ url('resources') }}">Resources</a>
                    </li>
                    <li class="nav-item {{Request::is('coaching') ? 'active' : 'else'}}">
                      <a class="nav-link" href="{{ url('coaching') }}">Coaching</a>
                    </li>

                    
                    @if(Auth::check())
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="icon-switch2"></i>
                        Log out
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/dashboard-home') }}" style="border: 2px solid #231f20; border-radius: 10px; padding: 3px;">My Account</a>
                    </li>
                    @else
                    <li class="nav-item {{Request::is('login') ? 'active' : 'else'}}">
                      <a class="nav-link" href="{{ url('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('register') }}" style="border: 2px solid #231f20; border-radius: 10px; padding: 3px;">Sign up</a>
                    </li>
                    @endif
                </ul>
              </div>
        </div>
      <!-- <div> -->
    </div>
  </nav>
</section>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>