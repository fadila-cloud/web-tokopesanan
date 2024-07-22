<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Toko') }}
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <div class="row pb-2">
            <div class="col">
              <h2 class="fs-2 fw-bold">Anda Melihat Toko{{ $data["nama_toko"] }}</h2>
            </div>
            <div class="col text-end">
              <a class="btn btn-info" href="{{ route('toko.edit',$data["id"]) }}">
                Edit Toko
              </a>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteToko">
                Delete Toko
              </button>
            </div>
          </div>
          <div class="card p-1">
            <div class="row">
              <div class="row">
                <div class="col-2 fw-bold">Nama Toko</div>
                <div class="col text-end">:</div>
                <div class="col-6">{{ $data["nama_toko"] }}</div>
              </div>
            </div>
            <div class="row">
              <div class="row">
                <div class="col-2 fw-bold">Lokasi</div>
                <div class="col text-end">:</div>
                <div class="col-6">{{ $data["lokasi"] }}</div>
              </div>
            </div>
          </div>
          <hr class="mt-1">
          <h4 class="fs-4 fw-bold mt-1">Yang membuat Toko {{ $data["nama_toko"] }}</h4>
          <table class="table table-bordered mt-1">
            <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th>{{ $data["user"]["id"] }}</th>
              <th>{{ $data["user"]["name"] }}</th>
              <th>{{ $data["user"]['email'] }}</th>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="deleteToko" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Toko {{ $data['nama_toko'] }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Apa anda yakin akan menghapus toko ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="post" action="{{ route('toko.destroy',$data['id']) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Yakin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
  
<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Pesanan') }}
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <div class="row pb-2">
            <div class="col">
              <h2 class="fs-2 fw-bold">Anda Melihat Pesanan{{ $data["nama_pesanan"] }}</h2>
            </div>
            <div class="col text-end">
              <a class="btn btn-info" href="{{ route('pesanan.edit',$data["id"]) }}">
                Edit Toko
              </a>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePesanan">
                Delete Pesanan 
              </button>
            </div>
          </div>
          <div class="card p-1">
            <div class="row">
              <div class="row">
                <div class="col-2 fw-bold">Nama Pesanan</div>
                <div class="col text-end">:</div>
                <div class="col-6">{{ $data["nama_pesanan"] }}</div>
              </div>
            </div>
            <div class="row">
              <div class="row">
                <div class="col-2 fw-bold">Toko</div>
                <div class="col text-end">:</div>
                <div class="col-6">{{ $data["toko"] }}</div>
              </div>
            </div>
          </div>
          <hr class="mt-1">
          <h4 class="fs-4 fw-bold mt-1">Yang membuat Pesanan {{ $data["nama_pesanan"] }}</h4>
          <table class="table table-bordered mt-1">
            <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th>{{ $data["user"]["id"] }}</th>
              <th>{{ $data["user"]["name"] }}</th>
              <th>{{ $data["user"]['email'] }}</th>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="deletePesanan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Pesanan {{ $data['nama_pesanan'] }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Apa anda yakin akan menghapus pesanan ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="post" action="{{ route('pesanan.destroy',$data['id']) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Yakin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
  