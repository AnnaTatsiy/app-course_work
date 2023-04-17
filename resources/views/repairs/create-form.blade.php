@extends('layouts.app')

@section('title', 'Добавление записи о ремонте')

@section('content')

    <form method="post" class="w-50" action="{{$isAdd ? '/repair/add' : "/repair/edit" }}">

        @csrf

        <input type="hidden" name="id" value="{{$isAdd ? 0  : $id}}">
        <input type="hidden" name="is_fixed" value="0"/>

        <p class="mt-4 ms-3 mb-4 fs-4" >Введите данные ремонта:</p>

        @if($isAdd)
            <input type="hidden" name="date_of_detection" value = "{{date("Y-m-d")}}"/>
        @else

            <div class="mt-3 ms-3" >
                <label class="form-label" for="id_date_of_detection">Дата сдачи авто:</label>
                <input class="form-control  @error('date_of_detection') is-invalid @enderror " type="date" name="date_of_detection" id = "id_date_of_detection"
                       value = "{{$date_of_detection}}"/>
            </div>
        @endif

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_date_of_correction">Дата возвращения авто из ремонта:</label>
            <input class="form-control  @error('date_of_correction') is-invalid @enderror " type="date" name="date_of_correction" id = "id_date_of_correction"
                   value = "{{$isAdd ? old('date_of_correction')  : $date_of_correction}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label for="malfunction" class="form-label">Неисправность:</label>
            <input class="form-control @error('malfunction') is-invalid @enderror" list="datalistMalfunctions" id="malfunction" type="text" name="malfunction"
                   value="{{$isAdd ? old('malfunction')  : $malfunction}}">
            <datalist id="datalistMalfunctions">
                @foreach($malfunctions as $malfunction)
                    <option
                        value="{{$malfunction->id}}">{{$malfunction->name_malfunction}} {{$malfunction->price}} ₽
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="spare_part" class="form-label">Деталь для ремонта:</label>
            <input class="form-control @error('spare_part') is-invalid @enderror" list="datalistSpare_parts" id="spare_part" type="text" name="spare_part"
                   value="{{$isAdd ? old('spare_part')  : $spare_part}}">
            <datalist id="datalistSpare_parts">
                @foreach($spare_parts as $spare_part)
                    <option
                        value="{{$spare_part->id}}">{{$spare_part->name_spare_part}} {{$spare_part->price}} ₽
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="worker" class="form-label">Id рабочего:</label>
            <input class="form-control @error('worker') is-invalid @enderror" list="datalistWorkers" id="worker" type="text" name="worker"
                   value="{{$isAdd ? old('worker')  : $worker}}">
            <datalist id="datalistWorkers">
                @foreach($workers as $worker)
                    <option
                        value="{{$worker->id}}">{{$worker->person->surname}} {{$worker->person->name}} {{$worker->person->patronymic}}
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="client" class="form-label">Id клиента:</label>
            <input class="form-control @error('client') is-invalid @enderror" list="datalistClients" id="client" type="text" name="client"
                   value="{{$isAdd ? old('client')  : $client}}">
            <datalist id="datalistClients">
                @foreach($clients as $client)
                    <option
                        value="{{$client->id}}">{{$client->person->surname}} {{$client->person->name}} {{$client->person->patronymic}}
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="car" class="form-label">Id авто:</label>
            <input class="form-control @error('car') is-invalid @enderror" list="datalistCars" id="car" type="text" name="car"
                   value="{{$isAdd ? old('car')  : $car}}">
            <datalist id="datalistCars">
                @foreach($cars as $car)
                    <option
                        value="{{$car->id}}">{{$car->color->name_color}} {{$car->brand->name_brand}} {{$car->state_number}}
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


