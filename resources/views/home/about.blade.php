@extends('layouts.app')

@section('title', 'О разработчике')

@section('about', 'active')

@section('content')
        <section class="w-50 mx-auto my-4 bg-light  rounded-3 p-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="border rounded bg-white shadow-sm">
                            <img class="w-100" src="images/62227bf7a3528.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="list-group shadow-sm">
                            <li class="list-group-item">
                                Разработчик: <b>Таций Анна</b>
                            </li>
                            <li class="list-group-item">
                                Группа: <b>ПД011</b>
                            </li>
                            <li class="list-group-item">
                                Город: <b>Донецк</b>
                            </li>
                            <li class="list-group-item">
                                Год создания: <b>2023</b>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
@endsection
