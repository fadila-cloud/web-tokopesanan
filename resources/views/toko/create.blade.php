@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Toko</h1>
    <form action="{{ route('tokos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Toko</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
