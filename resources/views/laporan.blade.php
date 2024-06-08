@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Penjualan Harian</h1>
                    <br>
                    <form action="{{ route('penjualan.cetak-pdf', 'tgl') }}">
                    <input name='tgl' id="tgl" type="date" required>
                    <br>
                    <div class="py-3">
                    <button type="submit" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Penjualan Bulanan</h1>
                    <br>
                    <form action="{{ route('penjualan.cetak-pdf-bulanan', 'bulan')}}">
                    <input id="bulan" name="bulan" type="month" required>
                    <br>
                    <div class="py-3">
                    <button type="submit" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Pemakain Obat Perbulan</h1>
                    <br>
                    <form action="{{ route('pemakaian.cetak-pdf', 'tgl') }}">
                    <input name="bulan" type="month">
                    <br>
                    <div class="py-3">
                    <button class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Tagihan Obat Perbulan</h1>
                    <br>
                    <form action="{{ route('pembelian.cetak-pdf', 'bulan') }}">
                    <input name='bulan' type="month">
                    <br>
                    <div class="py-3">
                    <button type="submit" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Cetak
                    </button>
                    </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>