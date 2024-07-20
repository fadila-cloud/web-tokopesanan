@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pesanan</h1>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Pesanan</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="details">Detail</label>
            <input type="text" name="details" id="details" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="toko_ids">Pilih Toko</label>
            <select name="toko_ids[]" id="toko_ids" class="form-control" multiple>
                @foreach($tokos as $toko)
                    <option value="{{ $toko->id }}">{{ $toko->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
