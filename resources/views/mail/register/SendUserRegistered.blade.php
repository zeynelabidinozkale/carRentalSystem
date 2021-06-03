@extends('layouts.mail')
@section('content')

<br> Hi, Your {{env('APP_NAME')}} login information is below <br> <br>

<strong>e-mail:</strong> {{$email}} <br>
<strong>Şifre:</strong> {{$password}} <br>

@endsection
