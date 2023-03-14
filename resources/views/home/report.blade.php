@extends('layouts.app')

@section('index', 'active')
@section('title', 'Отчет за выбранный месяц:')

<!-- секция контент -->
@section('content')

    <form class="row mt-4" method="post" action="/home/show-report">
        @csrf

        <p class="mt-2 mb-3 fs-5">Выберите месяц текущего года для получения отчета:</p>

        <div class="col-4">
            <label for="month" class="form-label">Месяцы:</label>
            <select class="form-select" name="month" id="month" >

                @for($i = 1; $i<13; $i++)
                    <option value="{{$i}}" {{($i == $selectMonth ? 'selected' : '')}}>
                        {{$months[$i]}}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-1 mt-4">
            <input class="btn btn-success" style="margin-top: 12px" type="submit" value="Выбрать"/>
        </div>

    </form>

    @if(count($report) == 0)
        <div class="mt-5 alert alert-success">
            Пока данных нет!
        </div>
    @else
    <table class="table mt-4">
        <thead>
        <tr>
            <th>Id неисправности</th>
            <th>Описание неисправности</th>
            <th>Количество неисправностей</th>
            <th>Прибыль</th>
        </tr>
        </thead>

        <tbody>
        @foreach($report as $r)
            <tr>
                <td>{{$r->id}}</td>
                <td>{{$r->name_malfunction}}</td>
                <td>{{$r->count_repairs}}</td>
                <td>{{$r->profit}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection


