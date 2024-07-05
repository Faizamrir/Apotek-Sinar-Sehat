<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Return Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <x-input-label for="no_faktur" :value="__('No faktur')" />
                    <select id="no_faktur" type="text" class="block w-full h-7 form-control" name="no_faktur" required autofocus ></select>
                    <x-input-error :messages="$errors->get('no_faktur')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="supplier" :value="__('Supplier')" />
                    <select id="supplier" class="block w-full mt-1" name="supplier" disabled>
                    <option value="" selected>--Pilih Supplier--</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="nama_obat" :value="__('Obat')" />
                    <select id="nama_obat" class="block w-full mt-1" name="nama_obat" required autofocus>
                        <option value="" selected>--Pilih Obat--</option>
                        {{-- @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" data-price="{{ $obat->harga }}">{{ $obat->nama_obat }}</option>
                        @endforeach --}}
                        </select>
                    <x-input-error :messages="$errors->get('nama_obat')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" type="number" class="block w-full mt-1" name="harga" readonly />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="jumlah" :value="__('Jumlah')" />
                    <x-text-input id="jumlah" type="number" class="block w-full mt-1" name="jumlah" default="1" min="1" required autofocus />
                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                </div>
                <br>
                <button id="tombol-tambah" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                    Tambah List Retur
                </button>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                {{-- <div class="max-w-xl"> --}}
                    {{-- <div class="p-6"> --}}
                        <table id="return_table" border="1" class="text-center display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id_obat</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                
                              
                            </tbody>
                        </table>
                    {{-- </div> --}}
                {{--     --}}
                <div class="max-w-xl">
                    <br>
                <button  id="tombol-simpan" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                    Simpan Retur
                </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@include('script.return-pembelian')