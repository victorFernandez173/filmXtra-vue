@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Has recibido este mensaje porque has restablecido la contraseña para tu cuenta con email {{$usuario->email}}.
    </p>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Si no has sido tú, por favor contáctanos.
    </p>
@endsection
