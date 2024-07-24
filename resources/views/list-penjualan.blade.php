@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tabel Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="pemakaian_table" class="text-center display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah Pemakaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($pemakaian as $row)
                            <tr>
                                <td>{{ $row->nama_obat }}</td>
                                <td>{{ $row->total_pemakaian }}</td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
