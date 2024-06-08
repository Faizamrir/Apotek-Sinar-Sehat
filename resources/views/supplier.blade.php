@if ($errors->any())
    @php
        notify()->error($errors->first());
    @endphp
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="tombol-tambah" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Tambah Supplier
                    </button>

                    <br>
                    <div class="p-6">
                        <table id="supplier_table" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Telp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr">
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->alamat }}</td>
                                    <td>{{ $supplier->kota }}</td>
                                    <td>{{ $supplier->telp }}</td>
                                    <td>
                                        <button data-id="{{ $supplier->id }}" class="editSupplier btn btn-info bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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
    
    @include('modals.supplier-modal')

</x-app-layout>


@include('script.supplier')