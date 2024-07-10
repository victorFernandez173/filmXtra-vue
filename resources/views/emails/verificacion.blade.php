@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Gracias por registrarte en filmXtra. Clica en el link debajo para verificar su email: {{$usuario->email}}.
    </p>
    <br/>
    @if(isset($url))
        <a href="{{$url}}" target="_blank" style="text-decoration: none; color: #1d9cd8; font-weight: 700;">Enlace de verificación</a>
    @else
        <span>Parece que ha habido un problema. No tenemos enlace.</span>
    @endif
    <br><br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Si no ha creado una cuenta, no se requiere ninguna acción adicional.
    </p>
@endsection
