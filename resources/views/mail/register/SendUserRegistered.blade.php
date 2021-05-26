@extends('layouts.mail')
@section('content')

<br>  Merhaba, {{env('APP_NAME')}} giriş bilgileriniz aşağıdadır. <br> <br>

<strong>e-mail:</strong> {{$email}} <br>
<strong>Şifre:</strong> {{$password}} <br>

@endsection
