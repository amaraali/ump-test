@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header"><strong>Enkripsi / Dekripsi</strong></div>
                    <div class="card-body">
                        <p>Simulasi enkripsi / dekripsi kalimat</p>
                        <form action="{{ route('enkripsi-dekripsi') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="text">Kalimat</label>
                                <input type="text" name="text" class="form-control mb-2" id="text"
                                    placeholder="Masukkan kalimat yang akan dienkripsi / dekripsi" required>
                                {{-- dropdown enkripsi or dekripsi --}}
                                <label for="type">Tipe</label>
                                <select class="form-select" name="type" id="type" required>
                                    <option value="encrypt">Enkripsi</option>
                                    <option value="decrypt">Dekripsi</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @if (session('result'))
                            <div class="alert alert-success mt-3">
                                <strong>Hasil:</strong> {{ session('result') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
