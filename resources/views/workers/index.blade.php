@extends('layouts.app')

@section('workersActive', 'active')
@section('title', 'Рабочие станции:')

<!-- секция контент -->
@section('content')

    <div class="col mt-2">

        <form class=" row" method="post" action="/workers/select-worker-by-malfunction-and-owner">
            @csrf

            <p class="mt-2 mb-3 fs-5">Выборка работника, устранявшего данную неисправность в автомобиле данного клиента:</p>

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

            <div class="col-4">
                <label for="client" class="form-label">Серия-номер паспорта клиента:</label>
                <input class="form-control" list="datalistClients" id="client" name="client" value="{{$selectClient}}">
                <datalist id="datalistClients">
                    <option value="0">Не указано для выборки</option>
                    @foreach($clients as $client)
                        <option
                            value="{{$client->id}}">{{$client->passport}} {{$client->person->surname}} {{$client->person->name}} {{$client->person->patronymic}}
                        </option>
                    @endforeach
                </datalist>

            </div>

            <div class="col-1 mt-4">
                <input class="btn btn-success" style="margin-top: 12px" type="submit" value="Выбрать"/>
            </div>

        </form>

        <div class="row-3 mt-2 mb-5">
            <a href="/workers/all" class="btn btn-warning">Сброс</a>
        </div>

    </div>

    <div class="d-flex justify-content-end">
        <div class="btn-group">
            <a class="btn btn-success" href="/worker/create">Добавить запись</a>
        </div>
    </div>

    @if(count($workers) == 0)
        <div class="mt-5 alert alert-danger">
            По вашему запросу ничего не найдено
        </div>
    @else

    <p class="fs-5 mt-3">Рабочие станции:</p>

    <table class="table mt-4">
        <thead>
        <tr>
            <th>Id</th>
            <th>ФИО</th>
            <th>Специальность</th>
            <th>Разряд</th>
            <th>Стаж</th>
        </tr>
        </thead>

        <tbody>
        @foreach($workers as $worker)
            <tr>
                <td>{{$worker->id}}</td>
                <td>{{$worker->person->surname}} {{$worker->person->name}} {{$worker->person->patronymic}}</td>
                <td>{{$worker->specialization->name_specialization}}</td>
                <td>{{$worker->workers_category}}</td>
                <td>{{$worker->experience}}</td>
                <td class='text-center'>
                    <a class="btn btn-success" title="Изменить" href="/worker/edit-form/{{$worker->id}}"><i class="bi bi-pencil-fill"></i></a>
                    <a class='btn btn-danger' title='Удалить' href="/worker/delete/{{$worker->id}}"><i class='bi bi-trash-fill'></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection

