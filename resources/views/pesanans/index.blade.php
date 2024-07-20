@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>
    <a href="{{ route('pesanans.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Detail</th>
                <th>Toko</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
                <tr>
                    <td>{{ $pesanan->name }}</td>
                    <td>{{ $pesanan->details }}</td>
                    <td>
                        @foreach($pesanan->tokos as $toko)
                            {{ $toko->name }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
