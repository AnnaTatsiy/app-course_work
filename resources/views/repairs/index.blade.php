@extends('layouts.app')

@section($pageActive, 'active')
@section("title", $title)

<!-- секция контент -->
@section('content')
    <p class="fs-5 mt-3">{{$title}}</p>

    <table class="table mt-4">
        <thead>
        <tr>
            <th>Id</th>
            <th>Id авто</th>
            <th>Модель авто</th>
            <th>Гос. номер</th>
            <th>Описание неисправности</th>
            <th>Выявлено</th>
            <th>Сдача авто</th>
            <th>Починено</th>
            <th>Стоимость ремонта</th>
            <th>Стоимость деталей</th>
            <th>Полная стоимость</th>
        </tr>
        </thead>

        <tbody>
        @foreach($repairs as $repair)
            <tr>
                <td>{{$repair->id}}</td>
                <td>{{$repair->cars_id}}</td>
                <td>{{$repair->brand}}</td>
                <td>{{$repair->state_number}}</td>
                <td>{{$repair->malfunction}}</td>
                <td>{{date("d.m.Y", strtotime($repair->date_of_detection))}}</td>
                <td>{{date("d.m.Y", strtotime($repair->date_of_correction))}}</td>
                <td>{{$repair->is_fixed ? "Да" : "Нет"}}</td>
                <td>{{$repair->malfunctions_price}} ₽</td>
                <td>{{$repair->spare_part_price}} ₽</td>
                <td>{{$repair->price}} ₽</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

