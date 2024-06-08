<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-input-label for="no_faktur" :value="__('No faktur')" />
                        <x-text-input id="no_faktur" type="text" class="block mt-1 w-full" name="no_faktur" required autofocus min="1" />
                        <x-input-error :messages="$errors->get('no_faktur')" class="mt-2" />
                    </div>
                    <br>
                    <div class="max-w-xl">
                        <x-input-label for="supplier" :value="__('Supplier')" />
                        <select id="supplier" class="block mt-1 w-full" name="supplier" required autofocus>
                        <option value="" selected>--Pilih Supplier--</option>
                        @foreach ($get_suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
                    </div>
                    <br>
                   
                <br>
                <hr class="h-px my-8 bg-gray-200 border-2 dark:bg-gray-700">
                <br>
                <div class="max-w-xl">
                    <x-input-label for="nama_obat" :value="__('Obat')" />
                    <select id="nama_obat" class="block mt-1 w-full" name="nama_obat" required autofocus>
                        <option value="" selected>--Pilih Obat--</option>
                        @foreach ($get_obat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                        @endforeach
                        </select>
                    <x-input-error :messages="$errors->get('nama_obat')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" type="text" class="block mt-1 w-full" name="harga" min="1"  required autofocus min="1" />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="jumlah" :value="__('Jumlah')" />
                    <x-text-input id="jumlah" type="number" class="block mt-1 w-full" name="jumlah" min="1" required autofocus min="1" />
                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="diskon" :value="__('Diskon')" />
                    <x-text-input id="diskon" type="number" placeholder='%' class="block mt-1 w-full" name="diskon" step="any" required autofocus min="1" />
                    <x-input-error :messages="$errors->get('diskon')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="total" :value="__('Total')" />
                    <x-text-input id="total" type="text" class="block mt-1 w-full" name="total" readonly />
                    <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                </div>
                <br>
                <button id="tombol-tambah" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Tambah List Pembelian
                </button>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{-- <div class="max-w-xl"> --}}
                    {{-- <div class="p-6"> --}}
                        <table id="pembelian_table" border="1" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Supplier</th>
                                    <th>id_obat</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                
                              
                            </tbody>
                            <tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></tfoot>
                        </table>
                    {{-- </div> --}}
                {{--     --}}
                <div class="max-w-xl">
                    <br>
                <button  id="tombol-simpan" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Simpan Pembelian
                </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@include('script.pembelian')