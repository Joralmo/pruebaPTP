<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title>Respuesta</title>
</head>

<body>
    <h2>Información de la transacción</h2>

    <table>
        <tr>
            <th>ID de la transacción</th>
            <td>{{$respuesta["transactionID"]}}</td>
        </tr>
        <tr>
            <th>Referencia</th>
            <td>{{$respuesta["reference"]}}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{$respuesta["requestDate"]}}</td>
        </tr>
        <tr>
            <th>Estado de la transacción</th>
            <td>{{$respuesta["transactionState"]}}</td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td>{{$respuesta["responseReasonText"]}}</td>
        </tr>
    </table>
</body>

</html>