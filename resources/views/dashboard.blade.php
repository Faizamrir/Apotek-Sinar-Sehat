@php
    use Illuminate\Support\Carbon;

    $count_obat_expired = $expired_date->filter(function ($item) {
        $expired = Carbon::parse($item->expired);
        return $expired->isPast();
    })->count();

    $count_faktur_jatuh_tempo = $jatuh_tempo->filter(function ($item) {
        $jatuh_tempos = Carbon::parse($item->jatuh_tempo);
        return $jatuh_tempos->isPast();
    })->count();

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-4 gap-4">
                        @if (count($expired_date) == 0)
                            <div class="block max-w-sm p-6 bg-green-500 border border-gray-200 rounded-lg shadow hover:bg-green-400">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">{{count($expired_date)}} Obat yang akan mendekati Expired</h5>
                            </div>
                        @elseif ($expired_date[0]->expired < now())
                            <div class="block max-w-sm p-6 bg-red-400 border border-gray-200 rounded-lg shadow hover:bg-red-200">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black-400 ">{{ $count_obat_expired }} Obat yang melebihi Expired</h5>
                            </div>
                        @elseif (count($expired_date) > 0 && $expired_date[0]->expired >= now())
                            <div class="block max-w-sm p-6 bg-yellow-400 border border-gray-200 rounded-lg shadow hover:bg-yellow-200">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black-400 ">{{ count($expired_date) }} Obat yang akan mendekati Expired</h5>
                            </div>
                        @endif
                        @if(Auth::user()->is_admin == 1)
                        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">Penjualan Hari ini</h5>
                            <p class="font-normal text-black dark:text-gray-400">Rp. {{number_format($penjualan, 2, ',', '.')}}</p>
                        </div>
                        @endif
                        @if (count($jatuh_tempo) == 0)
                        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">{{count($jatuh_tempo)}} Faktur akan Jatuh Tempo</h5>
                        </div>
                        @elseif ($jatuh_tempo[0]->jatuh_tempo < now())
                        <div class="block max-w-sm p-6 bg-red-400 border border-gray-200 rounded-lg shadow hover:bg-red-200">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">{{$count_faktur_jatuh_tempo}} Faktur melebihi Jatuh Tempo</h5>
                        </div>
                        @elseif (count($jatuh_tempo) > 0 && $jatuh_tempo[0]->jatuh_tempo >= now())
                        <div class="block max-w-sm p-6 bg-yellow-400 border border-gray-200 rounded-lg shadow hover:bg-yellow-200">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">{{count($jatuh_tempo)}} Faktur akan Jatuh Tempo</h5>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <div class="p-4 mt-3 bg-white shadow-sm sm:p-8 sm:rounded-lg">

            </div> --}}

        </div>
    </div>
</x-app-layout>
