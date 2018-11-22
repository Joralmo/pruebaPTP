<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formulario</title>
</head>

<body>
    @if(isset($error))
        {{$error}}
        <br>
        <a href="/">Volver</a>
    @else
        {{ Form::open(array('url' => '2', 'method' => 'post')) }}
            Indique el tipo de cuenta con que realizará el pago:<br>
            {{ Form::select('interfaz', array('0' => 'PERSONA', '1' => 'EMPRESA')) }}
            <br>
            Seleccione de la lista la entidad financiera con la cual desea realizar el pago:<br>
            <select class="form-control" name="bank">
                @foreach($array as $bank)
                <option value="{{$bank['bankCode']}}">{{$bank['bankName']}}</option>
                @endforeach
            </select>
            <br>
            {{Form::submit('Continuar')}}
        {{ Form::close() }}
    @endif
</body>

</html>