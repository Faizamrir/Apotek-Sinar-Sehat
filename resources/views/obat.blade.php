@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button  id="tombol-tambah" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Tambah Obat
                    </button>
                    <br>
                    <div class="p-6">
                        <table id="obat_table" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Stok</th>
                                    <th>harga</th>
                                    <th>Satuan</th>
                                    <th>Expired</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($obats as $obat)
                                <tr>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>{{ $obat->harga }}</td>
                                    <td>{{ isset($obat->satuan[0]) ? $obat->satuan[0]->satuan : '' }}</td>
                                    <td>{{ $obat->expired }}</td>
                                    <td>{{ isset($obat->supplier[0]) ? $obat->supplier[0]->nama_supplier : '' }}</td>
                                    <td>
                                        <button data-id="{{ $obat->id }}" class="editObat btn btn-info bg-blue hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                                        <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @include('modals.obat-modal')

</x-app-layout>

@include('script.obat')
