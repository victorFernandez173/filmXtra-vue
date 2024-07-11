@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Has recibido este mensaje porque has solicitado el restablecimiento de contraseña para tu cuenta con email {{$usuario->email}}. Clica en el link para proceder:
    </p>
    <br>
    <a href="{{$url}}" target="_blank" style="text-decoration: none; color: #1d9cd8; font-weight: 700;">Restablecer contraseña</a>
    <br><br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Este enlace de restablecimiento de contraseña expirará en 60 minutos.
    </p>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Si no ha solicitado el restablecimiento de contraseña, omita este mensaje de correo electrónico.
    </p>
@endsection
