@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Toko</h1>
    <a href="{{ route('tokos.create') }}" class="btn btn-primary">Tambah Toko</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tokos as $toko)
                <tr>
                    <td>{{ $toko->name }}</td>
                    <td>{{ $toko->location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
