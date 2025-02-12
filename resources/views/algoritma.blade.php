@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header"><strong>Array [5, 4, 1, 6, 8, 9, 7, 6, 3, 8, 7, 8, 10]</strong></div>
                    <div class="card-body">
                        <p>Menampilkan semau elemen dalam array yang lebih dari 6</p>
                        <ul class="list-group">
                            @forelse ($dataResult as $item)
                                <li class="list-group-item">{{ $item }}</li>
                            @empty
                                <li class="list-group-item">Tidak ada data</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header"><strong>Array [12, 7, 9, 14, 6, 3, 8, 10, 5, 4]</strong></div>
                    <div class="card-body">
                        <p>Menampilkan <strong>berapa banyak</strong> bilangan genap dalam array</p>
                        <ul class="list-group">
                            <li class="list-group-item">{{ $evenNumber ?? 'Tidak ada data!' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
