<div class="modal fade" id="modalsupplier" tabindex="-1" aria-labelledby="modalSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSupplier" method="POST" action="">
                @csrf
                <input id="change-method" type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalSupplierLabel">Form Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>

                <div class="mb-3 row">
                    <label for="nama_supplier" class="col-sm-2 col-form-label">Nama Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_supplier' id="nama_supplier">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="textarea" class="form-control" name='alamat' id="alamat">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='kota' id="kota">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name='telp' id="telp">
                    </div>
                </div>
                <input type="hidden" class="form-control" name='id' id="id" readonly>
                <!-- AKHIR FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="bg-white hover:bg-gray-100 hover:text-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow btnSimpan">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>