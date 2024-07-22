@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Gracias por acceder a {{ config('app.name') }} con tu cuenta de {{ $loginTipo->nombre }}.
    </p>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Si no has sido tu, cambia tu contraseña de {{ $loginTipo->nombre }} inmediatamente.
    </p>
@endsection
