@extends('layouts.app')

@section('title', 'Добавление клиента')

@section('content')

    <form method="post" class="w-50" action="{{$isAdd ? '/client/add' : "/client/edit" }}">

        @csrf

        <input type="hidden" name="id" value="{{$isAdd ? 0  : $id}}">

        <p class="mt-4 ms-3 mb-4 fs-4" >Введите данные клиента:</p>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_surname">Фамилия:</label>
            <input class="form-control  @error('surname') is-invalid @enderror " type="text" name="surname" id = "id_surname"
                   value = "{{$isAdd ? old('surname')  : $surname}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_name">Имя:</label>
            <input class="form-control  @error('name') is-invalid @enderror " type="text" name="name" id = "id_name"
                   value = "{{$isAdd ? old('name')  : $name}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_patronymic">Отчество:</label>
            <input class="form-control  @error('patronymic') is-invalid @enderror " type="text" name="patronymic" id = "id_patronymic"
                   value = "{{$isAdd ? old('patronymic')  : $patronymic}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_passport">Серия-номер паспорта:</label>
            <input class="form-control  @error('passport') is-invalid @enderror " type="text" name="passport" id = "id_passport"
                   value = "{{$isAdd ? old('passport')  : $passport}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_registration">Адрес проживания:</label>
            <input class="form-control  @error('registration') is-invalid @enderror " type="text" name="registration" id = "id_registration"
                   value = "{{$isAdd ? old('registration')  : $registration}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_date_of_birth">Дата рождения:</label>
            <input class="form-control  @error('date_of_birth') is-invalid @enderror " type="date" name="date_of_birth" id = "id_date_of_birth"
                   value = "{{$isAdd ? old('date_of_birth')  : $date_of_birth}}"/>
        </div>

        <div class="mt-3 ms-3 d-flex justify-content-end">
            <input class="btn btn-primary" type="submit" value="Отправить" />
        </div>

        @if ($errors->any())
            <div class="mt-5 ms-3 alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

    </form>


@endsection

