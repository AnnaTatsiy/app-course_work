@extends('layouts.app')

@section('clientsActive', 'active')
@section('title', 'Клиенты станции:')

<!-- секция контент -->
@section('content')

    <div class="col mt-2">

        <form class="row" method="post" action="/clients/select-client-by-state-number">
            @csrf

            <p class="mt-2 mb-3 fs-5">Выборка клиента с данным номером гос. регистрации:</p>

            <div class="col-4">
                <label for="stateNumber" class="form-label">Номером гос. регистрации:</label>
                <input class="form-control" list="datalistStateNumbers" id="stateNumber" name="stateNumber" value="{{$selectStateNumber}}">
                <datalist id="datalistStateNumbers">
                    @foreach($cars as $car)
                        <option
                            value="{{$car->id}}">{{$car->state_number}}
                        </option>
                    @endforeach
                </datalist>

            </div>

            <div class="col-1 mt-4">
                <input class="btn btn-success" style="margin-top: 12px" type="submit" value="Выбрать"/>
            </div>

        </form>

        <div class="col mt-5">

            <form class="row" method="post" action="/clients/select-client-by-malfunction">
                @csrf

                <p class="mt-2 mb-3 fs-5">Выборка клиентов,
                    сдавших в ремонт автомобили с указанным типом неисправности:</p>

                <div class="col-4">
                    <label for="malfunction" class="form-label">Неисправность:</label>
                    <input class="form-control" list="datalistMalfunctions" id="malfunction" name="malfunction" value="{{$selectMalfunction}}">
                    <datalist id="datalistMalfunctions">
                        @foreach($malfunctions as $malfunction)
                            <option
                                value="{{$malfunction->id}}">{{$malfunction->name_malfunction}}
                            </option>
                        @endforeach
                    </datalist>

                </div>

                <div class="col-1 mt-4">
                    <input class="btn btn-success" style="margin-top: 12px" type="submit" value="Выбрать"/>
                </div>

            </form>

        <div class="row-3 mt-2 mb-5">
            <a href="/clients/all" class="btn btn-warning">Сброс</a>
        </div>

    </div>

        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <a class="btn btn-success" href="/client/create">Добавить запись</a>
            </div>
        </div>

    @if(count($clients) == 0)
        <div class="mt-5 alert alert-danger">
            По вашему запросу ничего не найдено
        </div>
    @else
<p class="fs-5">Клиенты станции:</p>

<table class="table mt-4">
    <thead>
    <tr>
        <th>Id</th>
        <th>ФИО</th>
        <th>Паспорт</th>
        <th>Регистрация</th>
        <th>Дата рождения</th>
    </tr>
    </thead>

    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->person->surname}} {{$client->person->name}} {{$client->person->patronymic}}</td>
            <td>{{$client->passport}}</td>
            <td>{{$client->registration}}</td>
            <td>{{date("d.m.Y", strtotime($client->date_of_birth))}}</td>
            <td class='text-center'>
                <a class="btn btn-success" title="Изменить" href="/client/edit-form/{{$client->id}}"><i class="bi bi-pencil-fill"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    @endif
@endsection
