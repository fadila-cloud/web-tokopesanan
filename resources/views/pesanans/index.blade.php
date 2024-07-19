<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Pesanan</title>
    </head>
    <body>
        <h1>Daftar Pesanan</h1>
        <a href="{{route('pesanans.create')}}">Tambah Pesanan</a> 
        <ul>
            @foreach ($pesanans as $Pesanan)
                <li>
                    <a href="{{route('pesanans.show', $pesanan->id)}}">{{$pesanan->nama}}</a>
                    <a href="{{route('pesanans.edit', $pesanan->id)}}">Edit</a> 
                    <form action="{{route('pesanans.destroy', $pesanans->id)}}" method="POST" style="display:inline;">
                        @csrf 
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul> 
    </body>
</html>