<div class="modal fade" id="modalDataObat" tabindex="-1" aria-labelledby="modalDataObatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formObat" method="POST" action="">
            @csrf
            <input id="change-method" type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDataObatLabel">Form Obat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>

                <div class="mb-3 row">
                    <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_obat' id="nama_obat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name='stok' min="0" id="stok">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                            <input type="number" class="form-control" name='harga' min="0" id="harga">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="id_satuan" class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name='id_satuan' id="id_satuan">
                            <option value="" selected>--Pilih Satuan--</option>
                            @foreach ($get_satuan as $satuan)
                            <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="expired" class="col-sm-2 col-form-label">Expired</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name='expired' id="expired">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <select class="form-control" name='id_supplier' id="id_supplier">
                            <option value="" selected>--Pilih Supplier--</option>
                            @foreach ($get_supplier as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" class="form-control" name='id' id="id" readonly>
                <!-- AKHIR FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100 hover:text-gray-500 btnSimpan">tambah</button>
            </div>
        </form>
        </div>
    </div>
</div>