<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemakaian Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="pemakaian_table" class="display text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah Pemakaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemakaian as $row)
                            <tr>
                                <td>{{ $row->nama_obat }}</td>
                                <td>{{ $row->total_pemakaian }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('script.pemakaian')