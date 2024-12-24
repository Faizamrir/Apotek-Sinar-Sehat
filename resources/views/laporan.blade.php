@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold leading-tight text-gray-800">Laporan Penjualan Harian</h1>
                    <br>
                    <form action="{{ route('penjualan.cetak-pdf', 'tgl') }}">
                    <input name='tgl' id="tgl" type="date" required>
                    <br>
                    <div class="py-3">
                    <button type="submit" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold leading-tight text-gray-800">Laporan Penjualan Bulanan</h1>
                    <br>
                    <form action="{{ route('penjualan.cetak-pdf-bulanan', 'bulan')}}">
                    <input id="bulan" name="bulan" type="month" required>
                    <br>
                    <div class="py-3">
                    <button type="submit" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold leading-tight text-gray-800">Laporan Pemakaian Obat Perbulan</h1>
                    <br>
                    <form action="{{ route('pemakaian.cetak-pdf', 'tgl') }}">
                    <input name="bulan" type="month">
                    <br>
                    <div class="py-3">
                    <button class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold leading-tight text-gray-800">Laporan Tagihan Obat Perbulan</h1>
                    <br>
                    <form action="{{ route('pembelian.cetak-pdf', 'bulan') }}">
                    <input name='bulan' type="month">
                    <br>
                    <div class="py-3">
                    <button type="submit" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>
            
            <br>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold leading-tight text-gray-800">Daftar Stok Obat</h1>
                    <br>
                    <form action="{{ route('obat.laporan-daftar-obat') }}">
                    <div class="py-3">
                    <button type="submit" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            
        </div>
    </div>


</x-app-layout>