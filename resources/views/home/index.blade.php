@extends('layouts.app')
@section('content')
   {{--  @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif --}}
    <div id="myCarousel" class="slider carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="/img/1.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Renting a Car Is Now Easy</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-success" href="{{ route('home.reservation') }}" role="button">View Cars</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="/img/5.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Track Your Reservation</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-success" href="{{ route('home.reservation.track') }}" role="button">Track Your Reservation</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="/img/6.jpg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                    @guest
                    <h1>Sign Up And Make It Easy</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-success" href="{{ route('register') }}" role="button">Sign Up</a></p>
                    @endguest
                    @auth
                    <h1>Go To Your Account</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-success" href="{{ route('account.index') }}" role="button">My Account</a></p>
                    @endauth
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <div class="card shadow-lg reservation-box" >
            <div class="card-header text-center">
                <h5>Reservation Rorm</h5>
            </div>
            <div class="card-body">
                <form autocomplete="off" class="row" action="{{ route('home.reservation') }}">
                    <input type="hidden" name="step" value="vehicle">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pick_up_office_id">Select pickup location</label>
                            <select class="select2 form-control" name="pick_up_office_id">
                                <option value="">---</option>
                                @foreach ($offices as $office)
                                <option value="{{ $office->id }}" > {{$office->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="drop_off_office_id">
                                <input type='checkbox' id="collapseReturnLocation" {{--  data-toggle='collapse' data-target='#returnLocation' --}}>
                                Select Return location</label>
                                <div id="returnLocation" class="{{-- collapse --}} w-100">
                                    <select class="select2 form-control" name="drop_off_office_id">
                                        <option value="">---</option>
                                        @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" > {{$office->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date-range200">Select pickup and Return Date</label> <br>
                            <span id="two-inputs"><input class="datetimeInput" name="reservation_pick_up_datetime" id="date-range200" size="20" value=""> to <input class="datetimeInput" name="reservation_drop_off_datetime" id="date-range201" size="20" value=""></span>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-success btn-block" >Continue to Reservation <span data-feather="chevron-right"></span> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-150">
                    <h3>Showcase</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="carouselExampleControls1" class="cars carousel slide" data-ride="carousel" data-interval="100000">
                <div class="w-100 carousel-inner " role="listbox">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-right flex-auto" data-src="/img/car.jpg" src="/img/car.jpg "width="100%" data-holder-rendered="true">
                                        <div class="card-body">
                                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                <a href="#" class="btn btn-success ">See All <span data-feather="chevron-right"></span></a>
                </div>
            </div>
        </div>
    </section>



    {{-- <section class="bg-light pb-150 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h3>Testimonials</h3>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div id="carouselExampleControls" class="testimonials carousel slide " data-ride="carousel" data-interval="100000">
                <div class="w-100 carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="bg"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="row testimonial-box">
                                        <div class="col-sm-12">
                                        <h2>Micheal Smith - <span>Web Developer</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="row testimonial-box">
                                        <div class="col-sm-12">
                                        <h2>Helena Doe - <span>Architect</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="carousel-caption">
                                <div class="row testimonial-box">
                                    <div class="col-sm-12">
                                        <h2>Helena Doe - <span>Architect</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="bg"></div>
                            <div class="row">
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="row testimonial-box">
                                        <div class="col-sm-12">
                                        <h2>John Doe - <span>Ceo Mobile company</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carousel-caption">
                                    <div class="row testimonial-box">
                                        <div class="col-sm-12 ">
                                        <h2>Helena Doe - <span>Architect</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="carousel-caption">
                                    <div class="row testimonial-box">
                                    <div class="col-sm-12 ">
                                    <h2>Helena Doe - <span>Architect</span></h2>
                                        <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                        <small class="smallest mute">- willi</small>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section> --}}
        <!-- /END THE FEATURETTES -->
@endsection
@section('scripts')
<script>
$(function () {
    $("#returnLocation").hide();
    $('#collapseReturnLocation').click(function(){
        $("#returnLocation").toggle();
    });
    $('.select2').select2({
        theme: "bootstrap"
    });
    $('#two-inputs').dateRangePicker(
	{
		separator : ' to ',
        format: 'DD.MM.YYYY HH:mm',
        autoClose: true,
        time: {
			enabled: true
		},
        startDate: new Date(),
        defaultTime: moment().startOf('day').toDate(),
		defaultEndTime: moment().endOf('day').toDate(),
		getValue: function()
		{
			if ($('#date-range200').val() && $('#date-range201').val() )
				return $('#date-range200').val() + ' to ' + $('#date-range201').val();
			else
				return '';
		},
		setValue: function(s,s1,s2)
		{
			$('#date-range200').val(s1);
			$('#date-range201').val(s2);
		}
	});

});

</script>
@endsection
