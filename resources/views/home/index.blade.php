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
                <h1>Example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">View Cars</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="/img/5.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Another example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="/img/6.jpg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>One more for good measure.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Browse gallery</a></p>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pickUpLocation">Select pickup location</label>
                            <select class="select2 form-control" name="pickUpLocation">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="returnLocation"><input type='checkbox' data-toggle='collapse' data-target='#returnLocation'> Select Return location</label>
                            <div id="returnLocation" class="collapse w-100">
                                <select class="select2 form-control" name="returnLocation">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pickUpLocation">Select pickup and Return Date</label>
                            <input class="form-control" id="date-range1-1" size="60" value="">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-success btn-block" >Continue to Reservation <span data-feather="chevron-right"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-150">
                    <h4>Choose A Car</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="carouselExampleControls1" class="testimonials carousel slide" data-ride="carousel" data-interval="100000">
                <div class="w-100 carousel-inner " role="listbox">
                    <div class="carousel-item active">
                        <div class="bg"></div>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                <a href="#" class="btn btn-primary ">See All <span data-feather="chevron-right"></span></a>
                </div>
            </div>
        </div>
    </section>



<section class="bg-light pb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-150">
                    <h4>Testimonials</h4>
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
    </section>
        <!-- /END THE FEATURETTES -->
@endsection
@section('scripts')
<script>
$(function () {
    $('.select2').select2({
        theme: "bootstrap"
    });

    $('#date-range1-1').dateRangePicker(
	{
		startOfWeek: 'monday',
		separator : ' ~ ',
		format: 'DD.MM.YYYY HH:mm',
		autoClose: false,
		time: {
			enabled: true
		},
		defaultTime: moment().startOf('day').toDate(),
		defaultEndTime: moment().endOf('day').toDate()
	});
});

</script>
@endsection
