@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="no_faktur" :value="__('No faktur')" />
                                    <x-text-input id="no_faktur" class="block w-full mt-1" type="text" name="no_faktur" value="" />
                                </div>
                                <div>
                                    <x-input-label for="supplier" :value="__('Supplier')" />
                                    <select id="supplier" class="block w-full mt-1" name="supplier" required autofocus>
                                    <option value="" selected>--Pilih Supplier--</option>
                                    @foreach ($get_suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="tgl_transaksi" :value="__('Tgl Transaksi')" />
                                    <x-text-input id="tgl_transaksi" type="date" class="block w-full mt-1" name="tgl_transaksi" required />
                                </div>
                                <div>
                                    <x-input-label for="jatuh_tempo" :value="__('Jatuh Tempo')" />
                                    <x-text-input id="jatuh_tempo" type="date" class="block w-full mt-1" name="jatuh_tempo" required />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="diskon_faktur" :value="__('Potongan (opsional)')" />
                                <x-text-input id="diskon_faktur" class="block w-full mt-1" type="number" name="diskon" value=""/>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="nama_obat" :value="__('Obat')" />
                                    <select id="nama_obat" class="block w-full mt-1" name="nama_obat" required autofocus>
                                        <option value="" selected>--Pilih Obat--</option>
                                        @foreach ($get_obat as $obat)
                                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                                        @endforeach
                                        </select>
                                    <x-input-error :messages="$errors->get('nama_obat')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="harga" :value="__('Harga')" />
                                    <x-text-input id="harga" type="text" class="block w-full mt-1" name="harga" min="1"  required autofocus min="1" />
                                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="jumlah" :value="__('Jumlah')" />
                                    <x-text-input id="jumlah" type="number" class="block w-full mt-1" name="jumlah" min="1" required autofocus min="1" />
                                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="diskon" :value="__('Diskon')" />
                                    <x-text-input id="diskon" type="number" placeholder='%' class="block w-full mt-1" name="diskon" step="any" required autofocus min="1" />
                                    <x-input-error :messages="$errors->get('diskon')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="total" :value="__('Total')" />
                                <x-text-input id="total" type="text" class="block w-full mt-1" name="total" readonly />
                                <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button id="tombol-tambah" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                                {{ __('Tambah List Pembelian') }}
                            </button>
                        </div>
                </div>
                
            </div>

            <div class="p-4 mt-3 bg-white shadow sm:p-8 sm:rounded-lg">
                {{-- <div class="max-w-xl"> --}}
                    {{-- <div class="p-6"> --}}
                        <table id="pembelian_table" border="1" class="text-center display" style="width:100%">
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
                <div class="flex items-center justify-end mt-4">
                    <br>
                <button  id="tombol-simpan" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                    Simpan Pembelian
                </button>
                </div>
            </div>

        </div>
        
    </div>

            
</x-app-layout>

@include('script.pembelian')