@extends('layouts.app')

@section('title', 'Добавление рабочего')

@section('content')

    <form method="post" class="w-50" action="{{$isAdd ? '/worker/add' : "/worker/edit" }}">

        @csrf

        <input type="hidden" name="id" value="{{$isAdd ? 0  : $id}}">

        <p class="mt-4 ms-3 mb-4 fs-4" >Введите данные рабочего:</p>

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
            <label class="form-label" for="id_workers_category">Разряд:</label>
            <input class="form-control  @error('workers_category') is-invalid @enderror " type="number" name="workers_category" id = "id_workers_category"
                   value = "{{$isAdd ? old('workers_category')  : $workers_category}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_experience">Стаж работы:</label>
            <input class="form-control  @error('experience') is-invalid @enderror " type="number" name="experience" id = "id_experience"
                   value = "{{$isAdd ? old('experience')  : $experience}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label for="specialization" class="form-label">Специальность:</label>
            <input class="form-control @error('specialization') is-invalid @enderror" list="datalistSpecializations" id="specialization" type="text" name="specialization"
                   value="{{$isAdd ? old('specialization')  : $specialization}}">
            <datalist id="datalistSpecializations">
                @foreach($specializations as $specialization)
                    <option
                        value="{{$specialization->name_specialization}}">{{$specialization->name_specialization}}
                    </option>
                @endforeach
            </datalist>
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

