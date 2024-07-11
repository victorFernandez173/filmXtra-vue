@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Gracias por validar tu email {{$usuario->email}} en filmXtra.
    </p>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Ahora ya podrás acceder a todas las funcionalidades de la web como poner críticas, dar likes a críticas y mucho más...
    </p>
@endsection
