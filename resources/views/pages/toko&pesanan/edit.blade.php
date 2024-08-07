<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Toko') }}  
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <form method="post" action="{{ route('toko.update',$toko['id']) }}">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="mb-3">
                <label for="nama_toko" class="form-label fw-bold">{{ __('Id Toko') }}</label>
                <input id="nama_toko" name="nama_toko" type="text" class="form-control disabled" value="{{ $toko['id'] }}" placeholder="Coffe Bar" readonly autocomplete="nama_toko">
              </div>
              <div class="mb-3">
                <label for="nama_toko" class="form-label fw-bold">{{ __('Nama Toko') }}</label>
                <input id="nama_toko" name="nama_toko" type="text" class="form-control" value="{{ $toko['nama_toko'] }}" placeholder="Coffe Bar" required autocomplete="nama_toko">
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label for="lokasi" class="form-label fw-bold">{{ __('Alamat Toko') }}</label>
                <input id="lokasi" name="lokasi" type="text" class="form-control" value="{{ $toko['address'] }}" placeholder="Jl. Ahmad Yani, Blitar" required autocomplete="address">
              </div>
            </div>
            <div class="col col-span-6 sm:col-span-4 text-end mt-2">
              <button class="col btn btn-primary" type="submit">{{ __('Simpan')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </x-app-layout>

  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Pesanan')}} 
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <form method="post" action="{{ route('pesanan.update',$pesanan['id']) }}">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="mb-3">
                <label for="nama_pesanan" class="form-label fw-bold">{{ __('Id Pesanan') }}</label>
                <input id="nama_pesanan" name="nama_pesanan" type="text" class="form-control disabled" value="{{ $pesanan['id'] }}" placeholder="Mukena" readonly autocomplete="nama_pesanan">
              </div>
              <div class="mb-3">
                <label for="nama_pesanan" class="form-label fw-bold">{{ __('Nama Pesanan') }}</label>
                <input id="nama_pesanan" name="nama_pesanan" type="text" class="form-control" value="{{ $pesanan['nama_pesanan'] }}" placeholder="Pakaian" required autocomplete="nama_pesanan">
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label for="lokasi" class="form-label fw-bold">{{ __('Lokasi Toko') }}</label>
                <input id="lokasi" name="lokasi" type="text" class="form-control" value="{{ $data['lokasi'] }}" placeholder="Jl. Ahmad Yani, Blitar" required autocomplete="lokasi">
              </div>
            </div>
            <div class="col col-span-6 sm:col-span-4 text-end mt-2">
              <button class="col btn btn-primary" type="submit">{{ __('Simpan')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </x-app-layout>