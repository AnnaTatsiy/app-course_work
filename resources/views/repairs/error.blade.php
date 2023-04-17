@extends('layouts.app')

@section('title', $operation)

@section('content')

            <div class="mt-2 ms-2 alert alert-danger">
                <b>{{$operation}}:</b> {{$description}}. {{$operation}} было отменено!
            </div>

@endsection


