@extends('layouts.app')

@section('title', 'Добавление авто')

@section('content')

    <form method="post" class="w-50" action="{{$isAdd ? '/car/add' : "/car/edit" }}">

        @csrf

        <input type="hidden" name="id" value="{{$isAdd ? 0  : $id}}">

        <p class="mt-4 ms-3 mb-4 fs-4" >Введите данные авто:</p>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_year_of_release">Год выпуска:</label>
            <input class="form-control  @error('year_of_release') is-invalid @enderror " type="number" name="year_of_release" id = "id_year_of_release"
                   value = "{{$isAdd ? old('year_of_release')  : $year_of_release}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label class="form-label" for="id_state_number">Гос номер:</label>
            <input class="form-control  @error('state_number') is-invalid @enderror " type="text" name="state_number" id = "id_state_number"
                   value = "{{$isAdd ? old('state_number')  : $state_number}}"/>
        </div>

        <div class="mt-3 ms-3">
            <label for="brand" class="form-label">Модель авто:</label>
            <input class="form-control @error('brand') is-invalid @enderror" list="datalistBrands" id="brand" type="text" name="brand"
                   value="{{$isAdd ? old('brand')  : $brand}}">
            <datalist id="datalistBrands">
                @foreach($brands as $brand)
                    <option
                        value="{{$brand->name_brand}}">{{$brand->name_brand}}
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="color" class="form-label">Цвет авто:</label>
            <input class="form-control @error('color') is-invalid @enderror" list="datalistColors" id="color" type="text" name="color"
                   value="{{$isAdd ? old('color')  : $color}}">
            <datalist id="datalistColors">
                @foreach($colors as $color)
                    <option
                        value="{{$color->name_color}}">{{$color->name_color}}
                    </option>
                @endforeach
            </datalist>
        </div>

        <div class="mt-3 ms-3">
            <label for="owner" class="form-label">Id владелца авто:</label>
            <input class="form-control @error('owner') is-invalid @enderror" list="datalistOwners" id="owner" type="text" name="owner"
                   value="{{$isAdd ? old('owner')  : $owner}}">
            <datalist id="datalistOwners">
                @foreach($owners as $owner)
                    <option
                        value="{{$owner->id}}">{{$owner->person->surname}} {{$owner->person->name}} {{$owner->person->patronymic}}
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


