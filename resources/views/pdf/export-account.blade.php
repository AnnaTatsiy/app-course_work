
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; }

        table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
        }
        table thead th {
            font-weight: bold;
            text-align: left;
            border: 1px solid black;
            padding: 10px 15px;
            background: #d8d8d8;
            font-size: 14px;
        }
        table thead tr th:first-child {
            border-radius: 8px 0 0 8px;
        }
        table thead tr th:last-child {
            border-radius: 0 8px 8px 0;
        }
        table tbody td {
            text-align: left;
            border: 1px solid black;
            padding: 10px 15px;
            font-size: 14px;
            vertical-align: top;
        }

        table tbody tr td:first-child {
            border-radius: 8px 0 0 8px;
        }
        table tbody tr td:last-child {
            border-radius: 0 8px 8px 0;
        }

    </style>

</head>
<body>

<main>

    <p>Дата сдачи авто: <u>{{$date_of_detection}}</u><br>
        Дата возврата авто: <u>{{$date_of_correction}}</u></p>

    <p>Неисправности найденные в авто:</p>

    <table>
        <thead>
        <tr>
            <th>Описание неисправности</th>
            <th>Стоимость починки</th>
            <th>Деталь для ремонта</th>
            <th>Стоимость детали</th>
        </tr>
        </thead>

        <tbody>
        @foreach($malfunctions as $malfunction)
            <tr>
                <td>{{$malfunction->malfunction}}</td>
                <td>{{$malfunction->malfunctions_price}} ₽</td>
                <td>{{$malfunction->spare_part}}</td>
                <td>{{$malfunction->spare_part_price}} ₽</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Итого: {{$total}} ₽</p>

    <p>Дата выдачи счета: <u>{{$date}}</u></p>

</main>

</body>
</html>
