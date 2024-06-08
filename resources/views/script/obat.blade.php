<script>
    $(document).ready(function() {
        $('#obat_table').DataTable();
    });

    $('body').on('click', '#tombol-tambah', function(e) {
        e.preventDefault();
        $('#modalDataObat').modal('show');
        $('#formObat').attr('action', '{{ route('obat.store') }}');
        $('#change-method').val('POST');
        $('.modal-title').text('Tambah Form');
        $('.btnSimpan').text('Simpan');
    });

    $(document).ready(function(e) {
        $('.editObat').click(function(e) {
            e.preventDefault();
            let id_obat = $(this).data('id');   
            $.ajax({
                type: "GET",
                url: '/obat/edit/'+ id_obat,
                success: function (response) {
                    $('#formObat').attr('action', '{{ route('obat.update','')}}' + '/' + response.id);
                    $('#change-method').val('PUT');
                    $('.modal-title').text('Edit Form');
                    $('.btnSimpan').text('Update');
                    $('#nama_obat').val(response.nama_obat);
                    $('#stok').val(response.stok);
                    $('#harga').val(response.harga);
                    $('#id_satuan').val(response.id_satuan);
                    $('#expired').val(response.expired);
                    $('#id_supplier').val(response.id_supplier);
                    $('#id').val(response.id);

                    $('#modalDataObat').modal('show');
                }
            });
        })
    });

    $('#modalDataObat').on('hidden.bs.modal', function() {
        $('#nama_obat').val('');
        $('#harga').val('');
        $('#id_satuan').val('');
        $('#stok').val('');
        $('#expired').val('');
        $('#id_supplier').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
</script>