<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>

</head>
<body>

<main>

    <p>Дата сдачи авто: <u>{{$date_of_detection}}</u><br>
        Дата возврата авто: <u>{{$date_of_correction}}</u></p>

    <p>Неисправности найденные в авто:</p>

    <ul>
        @foreach($malfunctions as $malfunction)
            <li>{{$malfunction->malfunction}}</li>
        @endforeach
    </ul>

    <p>Дата выдачи расписки: <u>{{$date}}</u></p>

</main>

</body>
</html>

