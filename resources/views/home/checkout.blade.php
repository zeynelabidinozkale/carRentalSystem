@extends('layouts.app')
@section('content')
<div style="opacity:0; height:10px;">
    <?php
       print_r($checkoutFormInitialize);
     ?>
  </div>
<div class="mb-4">

</div>
<div id="iyzipay-checkout-form" class="responsive"></div>

<div class="mt-4">

</div>
@endsection
