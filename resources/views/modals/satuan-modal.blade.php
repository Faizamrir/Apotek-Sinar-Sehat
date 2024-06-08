<div class="modal fade" id="modalsatuan" tabindex="-1" aria-labelledby="modalSatuanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSatuan" method="POST" action="">
                @csrf
                <input id="change-method" type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalSatuanLabel">Form Satuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>

                <div class="mb-3 row">
                    <label for="satuan" class="col-sm-2 col-form-label">Nama Satuan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='satuan' id="satuan">
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