@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><strong>Identitas Pribadi</strong></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Nama : {{ Auth::user()->name ?? 'Amara Nur Ali' }}</li>
                            <li class="list-group-item">Email : {{ Auth::user()->email ?? 'amaranur25@gmail.com' }}</li>
                            <li class="list-group-item">No. HP : {{ Auth::user()->no_hp ?? '087899504557' }}</li>
                            <li class="list-group-item">Github :
                                <a href="https://github.com/amaraali"
                                    target="blank"><i>{{ Auth::user()->github ?? 'https://github.com/amaraali' }}</i></a>
                            </li>
                            <li class="list-group-item">Portfolio :
                                <a href="https://amaraa.me"
                                    target="blank"><i>{{ Auth::user()->portfolio ?? 'https://amaraa.me' }}</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
