
@extends('layouts.app')

@section('reportRepairsActive', 'active')
@section('title', 'Отчет о ремонтах за выбранный месяц:')

<!-- секция контент -->
@section('content')

    <form class="row mt-4" method="post" action="/home/report-about-repairs">
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
                <th>Id авто</th>
                <th>Модель авто</th>
                <th>Гос. номер</th>
                <th>Выявлено</th>
                <th>Сдача авто</th>
                <th>Починено</th>
                <th>Описание неисправности</th>
                <th>ФИО рабочего</th>
            </tr>
            </thead>

            <tbody>
            @foreach($report as $r)
                <tr>
                    <td>{{$r->cars_id}}</td>
                    <td>{{$r->brand}}</td>
                    <td>{{$r->state_number}}</td>
                    <td>{{$r->date_of_detection}}</td>
                    <td>{{$r->date_of_correction}}</td>
                    <td>{{$r->is_fixed}}</td>
                    <td>{{$r->name_malfunction}}</td>
                    <td>{{$r->worker}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection



