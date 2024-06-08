<script>
    $(document).ready(function() {
        $('#supplier_table').DataTable();
    });


    $('body').on('click', '#tombol-tambah', function(e) {
        e.preventDefault();
        $('#modalsupplier').modal('show');
        $('#formSupplier').attr('action', '{{ route('supplier.store') }}');
        $('#change-method').val('POST');
        $('.modal-title').text('Tambah Form');
        $('.btnSimpan').text('Simpan');
    });

    $(document).ready(function(e) {
        $('.editSupplier').click(function(e) {
            e.preventDefault();
            let id_supplier = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '/supplier/edit/'+ id_supplier,
                success: function (response) {
                    $('#formSupplier').attr('action', '{{ route('supplier.update','')}}' + '/' + response.id);
                    $('#change-method').val('PUT');
                    $('.modal-title').text('Edit Form');
                    $('.btnSimpan').text('Update');
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#alamat').val(response.alamat);
                    $('#kota').val(response.kota);
                    $('#telp').val(response.telp);
                    $('#id').val(response.id);

                    $('#modalsupplier').modal('show');
                }
            });
        })
    });

    $('#modalsupplier').on('hidden.bs.modal', function() {
        $('#nama_supplier').val('');
        $('#alamat').val('');
        $('#kota').val('');
        $('#telp').val('');
        $('#id').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
</script>