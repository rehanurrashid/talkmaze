@extends('user.layouts.main')

@section('title', 'Partners')

@section('content')
<!----------------------Nav Bar---------------------------->
@include('user.partials.navbar')
    <!--  -->
    <section class="hero-section">
        <div class="container text-center">
            <div class="row" style="margin-right: 0px!important;">
                <div class="col-lg-5 col-md-5 text-justify m-auto">
                    <div class=" text-center">
                        <h1 class="text-uppercase mt-2">We Want To Work </h1>
                        <h1 class="mb-3 text-uppercase">With You</h1>
                        <a href="#partner-with-us">
                            <button type="button" class="btn btn-dark text-uppercase mt-4">Partner with us</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 m-auto">
                    <div class="hub-img2">
                        <img class="img-fluid mt-3 mb-3" src="{{asset('images/partner.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-us-sec mt-5">
        <div class="container">
            <div class="row" id="partner-with-us">
                <div class="col-md-12">
                    <div class="text-center">
                        <h4 class="text-dark  text-uppercase pb-2">Partners</h4>
                        <div class="inner">&nbsp;</div>
                        <p class="text-justify text-dark about-us-txt mt-5">Lorem Ipsum is simply dummy text of the
                            printing
                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                            the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into electronic
                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                            publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
            @forelse($partners as $partner)
                <div class="col-md-2">
                    <div class="text-center">
                        <img class="img-fluid mt-2" src="{{ (!empty($partner->image)) ? asset('storage/storage/'.$partner->image) : asset('images/logoimg.png') }}">
                    </div>
                </div>
            @empty
            <div class="col-md-12 mt-3">
                <h3 class="text-center">No Partners Found!</h3>
            </div>
            @endforelse
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <button type="button" class="btn btn-dark text-uppercase mt-5">Partner with us</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!----------------------Footer ---------------------------->
@include('user.partials.footer')

<!----------------------Copyright---------------------------->
@include('user.partials.copyright')

@endsection
