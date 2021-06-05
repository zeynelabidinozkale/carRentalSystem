@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css">
<style>
    #map{
        height: 400px;
        border-radius: 4px;
        border:4px solid rgb(17, 141, 17) ;
    }
</style>
@endsection
@section('content')
      <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <img src="{{asset('/assets/brand/logo.svg')}}" class="translate-logo mb-2" height="100">
                    <h3>{{ env('APP_NAME') }} - Our Offices</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div id="map" class="map shadow-lg mb-5 mt-4" ></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Tel</th>
                            <th>Address</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $office->name }}</td>
                              <td>{{ $office->email }}</td>
                              <td>{{ $office->tel }}</td>
                              <td>{{ $office->address }}</td>
                              <td>
                                    <a class="btn btn-success" href="tel:{{$office->tel}}"> <span data-feather="phone"></span></a>
                                    <a class="btn btn-primary" href="mailto:{{$office->email}}"> <span data-feather="mail"></span></a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $offices->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
<script>
    @foreach ($locations as $office)
    @if(is_numeric($office->latitude) && $office->longitude)
    var office_{{$office->id}} = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([{{$office->latitude}},{{$office->longitude}}]))
    });
    @endif
    @endforeach

    var vectorSource = new ol.source.Vector({
        features: [ @foreach ($locations as $office) @if(is_numeric($office->latitude) && $office->longitude) office_{{$office->id}}, @endif @endforeach ]
    });

var mandalay = ol.proj.fromLonLat([35.4149661,39.1604993]);
var view = new ol.View({
  center: mandalay,
  zoom: 6
});

var vectorSource = new ol.source.Vector({});
var places = [

    @foreach ($locations as $office)
        @if(is_numeric($office->latitude) && $office->longitude)
        [{{$office->latitude}},{{$office->longitude}},"{{asset('/assets/brand/mapIcon.png')}}"],
        @endif
    @endforeach

];

var features = [];
for (var i = 0; i < places.length; i++) {
  var iconFeature = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.transform([places[i][0], places[i][1]], 'EPSG:4326', 'EPSG:3857')),
  });


  var iconStyle = new ol.style.Style({
    image: new ol.style.Icon({
      src: places[i][2],
      color: places[i][3],
      crossOrigin: 'anonymous',
    })
  });
  iconFeature.setStyle(iconStyle);
  vectorSource.addFeature(iconFeature);
}



var vectorLayer = new ol.layer.Vector({
  source: vectorSource,
  updateWhileAnimating: true,
  updateWhileInteracting: true
});

var map = new ol.Map({
  target: 'map',
  view: view,
  layers: [
    new ol.layer.Tile({
      preload: 3,
      source: new ol.source.OSM(),
    }),
    vectorLayer,
  ],
  loadTilesWhileAnimating: true,
});

</script>
@endsection
