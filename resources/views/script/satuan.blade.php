<script>
    $(document).ready(function() {
        $('#satuan_table').DataTable();
    });


    $('body').on('click', '#tombol-tambah', function(e) {
        e.preventDefault();
        $('#modalsatuan').modal('show');
        $('#formSatuan').attr('action', '{{ route('satuan.store') }}');
        $('#change-method').val('POST');
        $('.modal-title').text('Tambah Form');
        $('.btnSimpan').text('Simpan');
    });

    $(document).ready(function(e) {
        $('.editSatuan').click(function(e) {
            e.preventDefault();
            let id_satuan = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '/satuan/edit/'+ id_satuan,
                success: function (response) {
                    $('#formSatuan').attr('action', '{{ route('satuan.update','')}}' + '/' + response.id);
                    $('#change-method').val('PUT');
                    $('.modal-title').text('Edit Form');
                    $('.btnSimpan').text('Update');
                    $('#satuan').val(response.satuan);
                    $('#id').val(response.id);

                    $('#modalsatuan').modal('show');
                }
            });
        })
    });

    $('#modalsatuan').on('hidden.bs.modal', function() {
        $('#satuan').val('');
        $('#id').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
</script>