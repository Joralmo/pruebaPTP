<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formulario</title>
</head>

<body>
    <?php
        $fecha = date('c');
        echo $fecha;
        echo "<br>";
        $trasnKey = "024h1IlD";
        echo $trasnKey;
        $hash = sha1($fecha.$trasnKey, false);
        echo "<br>";
        echo $hash;
    ?>
    <div id="app">
        <example-component></example-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>