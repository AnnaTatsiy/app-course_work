@extends('layouts.app')

@section('title', $description)

@section('content')

            <div class="mt-2 ms-2 alert alert-danger">
                <b>{{$description}}:</b> клиент с id = {{$id}} не был найден. {{$operation}} было отменено!
            </div>

@endsection


