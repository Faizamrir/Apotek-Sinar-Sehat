@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                {{-- <form method="POST" action="{{ route('penjualan.store') }}">
                    @csrf --}}
                <div class="grid grid-cols-2 gap-6">
                    <div class="grid grid-rows-2 gap-6">
                        <div>
                            <x-input-label for="obat" :value="__('Obat')" />
                            <select id="obat" class="block w-full mt-1" name="obat" required autofocus>
                            <option value="" selected>--Pilih Obat--</option>
                            @foreach ($get_obat as $obat)
                                <option value="{{ $obat->nama_obat }}" data-id="{{ $obat->id }}" data-stok="{{ $obat->stok }}" data-price="{{ $obat->harga }}">{{ $obat->nama_obat }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" class="block w-full mt-1" name="harga" readonly />
                        </div>
                        <div>
                            <x-input-label for="jumlah" :value="__('Jumlah')" />
                            <x-text-input id="jumlah" type="number" class="block w-full mt-1" name="jumlah" required autofocus min="1" />
                        </div>
                        <div>
                            <x-input-label for="subtotal" :value="__('Subtotal')" />
                            <x-text-input id="subtotal" class="block w-full mt-1" name="subtotal" readonly />
                        </div>
                        
                    </div>
                    <div class="grid grid-rows-4 gap-6">
                        <div>
                            <x-input-label for="total" :value="__('Total')" />
                            <x-text-input id="total" type="text" class="block w-full mt-1" name="total" readonly />
                        </div>
                        <div>
                            <x-input-label for="uang_bayar" :value="__('Uang Bayar')" />
                            <x-text-input id="uang_bayar" class="block w-full mt-1" name="uang_bayar" readonly />
                        </div>
                        <div>
                            <x-input-label for="uang_kembali" :value="__('Uang Kembali')" />
                            <x-text-input id="uang_kembali" class="block w-full mt-1" name="uang_kembali" readonly />
                        </div>
                    </div>
                    
                </div>
                <br>
                <button  id="tombol-tambah" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                    Tambah List Transaksi
                </button>
            {{-- </form> --}}
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                {{-- <div class="max-w-xl"> --}}
                    {{-- <div class="p-6"> --}}
                        <table id="penjualan_table" class="text-center display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($penjualans as $penjualan)
                                <tr>
                                    <td>{{ $penjualan->created_at }}</td>
                                    <td>{{ $penjualan->obat }}</td>
                                    <td>{{ $penjualan->jumlah }}</td>
                                    <td>{{ $penjualan->total }}</td>
                                </tr>
                                @endforeach --}}
                                {{-- <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <td>{{ $totals }}</td>
                                </tr> --}}
                            </tbody>
                            <tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th></tr></tfoot>
                        </table>
                        <div class="flex items-center justify-end mt-4">
                            <br>
                        <button  id="tombol-simpan" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                            Simpan Transaksi
                        </button>
                        </div>
                    {{-- </div> --}}
                {{--     --}}
            </div>

        </div>
    </div>
</x-app-layout>

@include('script.penjualan')