@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('penjualan.store') }}">
                    @csrf
                <div class="max-w-xl">
                    <x-input-label for="obat" :value="__('Obat')" />
                    <select id="obat" class="block mt-1 w-full" name="obat" required autofocus>
                    <option value="" selected>--Pilih Obat--</option>
                    @foreach ($get_obat as $obat)
                        <option value="{{ $obat->nama_obat }}" data-price="{{ $obat->harga }}">{{ $obat->nama_obat }}</option>
                    @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" class="block mt-1 w-full" name="harga" readonly />
                    <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="jumlah" :value="__('Jumlah')" />
                    <x-text-input id="jumlah" type="number" class="block mt-1 w-full" name="jumlah" required autofocus min="1" />
                    <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                </div>
                <br>
                <div class="max-w-xl">
                    <x-input-label for="total" :value="__('Total')" />
                    <x-text-input id="total" type="number" class="block mt-1 w-full" name="total" readonly />
                    <input type="hidden" id="nama_akun" name="nama_akun">
                    <x-input-error :messages="$errors->get('obat')" class="mt-2" />
                </div>
                <br>
                <button  id="tombol-tambah" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Tambah Transaksi
                </button>
            </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{-- <div class="max-w-xl"> --}}
                    {{-- <div class="p-6"> --}}
                        <table id="penjualan_table" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tgl Transaksi</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualans as $penjualan)
                                <tr>
                                    <td>{{ $penjualan->created_at }}</td>
                                    <td>{{ $penjualan->obat }}</td>
                                    <td>{{ $penjualan->jumlah }}</td>
                                    <td>{{ $penjualan->total }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <td>{{ $totals }}</td>
                                </tr>
                            </tbody>
                        </table>
                    {{-- </div> --}}
                {{--     --}}
            </div>

        </div>
    </div>
</x-app-layout>

@include('script.penjualan')