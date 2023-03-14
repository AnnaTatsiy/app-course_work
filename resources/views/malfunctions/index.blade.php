@extends('layouts.app')

@section('malfunctionsActive', 'active')
@section('title', 'Неисправности:')

<!-- секция контент -->
@section('content')

    <div class="col mt-2">

        <form class="row" method="post" action="/malfunctions/select-malfunctions-by-owner">
            @csrf

            <p class="mt-2 mb-3 fs-5">Перечень устраненных неисправностей в автомобиле данного владельца:</p>

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
                <a href="/malfunctions/all" class="btn btn-warning">Сброс</a>
            </div>

        </div>

        @if(count($malfunctions) == 0)
            <div class="mt-5 alert alert-danger">
                По вашему запросу ничего не найдено
            </div>
        @else
            <p class="fs-5 mt-3">Неисправности:</p>

            <table class="table mt-4">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Описание</th>
                    <th>Стоимость исправления</th>
                </tr>
                </thead>

                <tbody>
                @foreach($malfunctions as $malfunction)
                    <tr>
                        <td>{{$malfunction->id}}</td>
                        <td>{{$malfunction->name_malfunction}}</td>
                        <td>{{$malfunction->price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    @endif
@endsection

