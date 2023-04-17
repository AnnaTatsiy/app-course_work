@extends('layouts.app')

@section($pageActive, 'active')
@section("title", $title)

<!-- секция контент -->
@section('content')

    @if($is_repairs)
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <a class="btn btn-success" href="/repair/create">Добавить запись</a>
            </div>
        </div>
    @endif

    <p class="fs-5 mt-3">{{$title}}</p>

    @if(count($repairs) == 0)
        <div class="mt-5 alert alert-danger">
            По вашему запросу ничего не найдено
        </div>
    @else

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
                    @if($is_repairs)
                        <td class='text-center'>
                            <a class="btn btn-warning m-1" title="Создать расписку" href="/repair/generate-receipt/{{$repair->cars_id}}"><i
                                    class="bi bi-file-earmark-arrow-up"></i></a>
                            <a class="btn btn-primary m-1" title="Создать счет" href="/repair/generate-account/{{$repair->cars_id}}"><i
                                    class="bi bi-file-earmark-check"></i></a>
                            <a class="btn btn-success m-1" title="Изменить" href="/repair/edit-form/{{$repair->id}}"><i
                                    class="bi bi-pencil-fill"></i></a>
                            <a class='btn btn-danger m-1' title='Удалить' href="/repair/delete/{{$repair->id}}"><i
                                    class='bi bi-trash-fill'></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

