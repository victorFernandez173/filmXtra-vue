@extends('emails.template')

@section('content')
    <br>
    <h4>Hola {{$usuario->usuario}}:</h4>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Te confirmamos que tu cuenta de filmxtra
        @if($loginTipo->id != \App\Models\LoginTipo::FILMXTRA_TIPO)
            <span>
                ({{$loginTipo->nombre}})
            </span>
        @endif
        con email {{$usuario->email}} ha sido dada de baja.
    </p>
    <br>
    <p class="azul-oscuro" style="color: #2a4467; font-weight: 300;">
        Lamentamos que te vayas, pero seguiremos por aquí por si quieres volver con nosotros! Muchas gracias por tu colaboración!!!
    </p>
@endsection
