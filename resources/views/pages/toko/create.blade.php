<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Buat Toko') }}
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <form method="post" action="{{ route('toko.store') }}">
            @csrf
            @method('POST')
            <div class="row">
              <div class="mb-3">
                <label for="nama_toko" class="form-label fw-bold">{{ __('Nama Toko') }}</label>
                <input id="nama_toko" name="nama_toko" type="text" class="form-control" placeholder="Coffe Bar" required autocomplete="nama_toko">
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label for="lokasi" class="form-label fw-bold">{{ __('Lokasi') }}</label>
                <input id="lokasi" name="lokasi" type="text" class="form-control" placeholder="Jl. Ahmad Yani, Blitar" required autocomplete="lokasi">
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
        {{ __('Buat Pesanan') }} 
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <form method="post" action="{{ route('pesanan.store') }}">
            @csrf
            @method('POST')
            <div class="row">
              <div class="mb-3">
                <label for="nama_pesanan" class="form-label fw-bold">{{ __('Nama Pesanan') }}</label>
                <input id="nama_pesanan" name="nama_pesanan" type="text" class="form-control" placeholder="Mukena" required autocomplete="nama_pesanan">
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label for="toko" class="form-label fw-bold">{{ __('Toko') }}</label>
                <input id="toko" name="lokasi" type="text" class="form-control" placeholder="Jl. Ahmad Yani, Blitar" required autocomplete="toko">
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