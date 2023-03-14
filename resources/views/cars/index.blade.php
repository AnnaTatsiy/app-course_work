@extends('layouts.app')

@section('$carsActive', 'active')
@section('title', 'Авто станции:')

<!-- секция контент -->
@section('content')

    <div class="col mt-2">

        <form class=" row" method="post" action="/cars/select-car-by-owner">
            @csrf

            <p class="mt-2 mb-3 fs-5">Выборка авто заданного владельца:</p>

            <div class="col-4">
                <label for="owner" class="form-label">Серия-номер паспорта владельца:</label>
                <input class="form-control" list="datalistOptions" id="owner" name="owner" value="{{$selectOwner}}">
                <datalist id="datalistOptions">
                    @foreach($owners as $owner)
                        <option
                            value="{{$owner->id}}">{{$owner->passport}} {{$owner->person->surname}} {{$owner->person->name}} {{$owner->person->patronymic}}
                        </option>
                    @endforeach
                </datalist>

            </div>


            <div class="col-1 mt-4">
                <input class="btn btn-success" style="margin-top: 12px" type="submit" value="Выбрать"/>
            </div>

        </form>

        <div class="row-3 mt-2 mb-5">
            <a href="/cars/all" class="btn btn-warning">Сброс</a>
        </div>

    </div>

    @if(count($cars) == 0)
        <div class="mt-5 alert alert-danger">
            По вашему запросу ничего не найдено
        </div>
    @else
    <p class="fs-5 mt-3">Авто станции:</p>

    <table class="table mt-4">
        <thead>
        <tr>
            <th>Id</th>
            <th>Модель авто</th>
            <th>Цвет</th>
            <th>Год выпуска</th>
            <th>Гос. номер</th>
            <th>Паспорт владельца авто</th>
        </tr>
        </thead>

        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{$car->id}}</td>
                <td>{{$car->brand->name_brand}} </td>
                <td>{{$car->color->name_color}}</td>
                <td>{{date("d.m.Y", strtotime($car->year_of_release))}}</td>
                <td>{{$car->state_number}}</td>
                <td>{{$car->client->passport}}</td>
                <td class='text-center'>
                    <a class="btn btn-success" title="Изменить" href="/shoes/edit-form/{{$car->id}}"><i
                            class="bi bi-pencil-fill"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection


