
@extends('layouts.app')

@section('specializationsActive', 'active')
@section('title', 'Список специальностей рабочих:')

<!-- секция контент -->
@section('content')
    <p class="fs-5 mt-3">Список специальностей рабочих:</p>

    <table class="table mt-4">
        <thead>
        <tr>
            <th>Id</th>
            <th>Специальность</th>
            <th>Количество рабочих</th>
        </tr>
        </thead>

        <tbody>
        @foreach($specializations as $s)
            <tr>
                <td>{{$s->id}}</td>
                <td>{{$s->name_specialization}}</td>
                <td>{{$s->count_workers}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


