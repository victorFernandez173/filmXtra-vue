<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logueo con {{ $loginTipo->nombre }}</title>
</head>
<body>
<h1>Hola: {{ $user->usuario }}</h1>
<h3>Gracias por acceder a {{ config('app.name') }} con tu cuenta de {{ $loginTipo->nombre }}.</h3>
<h4>Si no has sido tu, cambia tu contraseña de {{ $loginTipo->nombre }} inmediatamente.</h4>
</body>
</html>
