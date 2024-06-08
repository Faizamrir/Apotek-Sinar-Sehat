@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel Faktur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="faktur_table" class="display text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>No Faktur</th>
                                <th>Nama Supplier</th>
                                <th>Tgl Transaksi</th>
                                <th>Jatuh Tempo</th>
                                <th>Diskon</th>
                                <th>PPN</th>
                                <th>Penerima</th>
                                <th>Total</th>
                                <th>Status Lunas</th>
                                <th>Detail Pembelian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fakturs as $faktur)
                            <tr>
                                <td>{{ $faktur->no_faktur }}</td>
                                <td>{{ $faktur->supplier->nama_supplier}}</td>
                                <td>{{ $faktur->tgl_transaksi }}</td>
                                <td>{{ $faktur->jatuh_tempo }}</td>
                                <td>{{ $faktur->diskon }}</td>
                                <td>{{ $faktur->ppn }}</td>
                                <td>{{ $faktur->penerima }}</td>
                                <td>{{ $faktur->total }}</td>
                                <td>{{ $faktur->status_lunas ? 'Lunas' : 'Belum Lunas' }}</td>
                                <td><button class="btn btn-info" data-obat = "{{ json_encode($faktur) }}">View</button></td>
                                <td>
                                    <buttons data-faktur="{{ $faktur->no_faktur }}" data-status="{{ $faktur->status_lunas }}" class="btn btn-info">
                                    Lunasi
                                  </buttons>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('modals.pembelian-modal')
</x-app-layout>

@include('script.faktur')