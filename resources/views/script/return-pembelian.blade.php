<script>
    
    $(document).ready(function() {
        datarow = []
        table = $('#return_table').DataTable({
            data: datarow,
            columns: [
                {data: 'id_obat', visible: false},
                {data: 'nama_obat'},
                {data: 'jumlah'},
            ],
            columnDefs: [
                {
                    target: 1,
                    visible: false,
                    searchable: false
                }
            ],
        });

        function addrow(id_obat, nama_obat, jumlah) {
        datarow.push({
            id_obat: id_obat,
            nama_obat: nama_obat,
            jumlah: jumlah,
        });
        table.clear().rows.add(datarow).draw();
        }

        $('#tombol-tambah').click(function () {
            let obat = $('#nama_obat option:selected').text();
            let id = $('#nama_obat option:selected').data('id');
            let jumlah = $('#jumlah').val();
            addrow(id, obat, jumlah);
        });


        $('#tombol-simpan').click(function () {
            let no_faktur = $('#no_faktur').val();
            let tabledata = table.rows().data().toArray();
            let formdata = {
                no_faktur: no_faktur,
                table_data: tabledata
            };
            $.ajax({
                type: "POST",
                url: "{{ route('returnpembelian.store') }}",
                datatype: 'JSON',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formdata,
                success: function(response) {
                window.location.href = "{{ route('returnpembelian.index') }}";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


    
    data = [];
    $('#no_faktur').select2({
        ajax:{
            url: "{{ route('faktur.get-faktur') }}",
            datatype: 'JSON',
            delay: 250,
            processResults: function(response) {
                data = response;
                return {
                    results: $.map(response, function(item) {
                        return {
                            text: item.no_faktur,
                            id: item.no_faktur
                        }
                    })
                }
            },
            cache: true
        }
    });

    

    $('#no_faktur').on('change', function() {
        $('#supplier').val(data[0].id_supplier).trigger('change');
        $('#nama_obat').empty();
        $('#nama_obat').append('<option value="" selected>--Pilih Obat--</option>');
        $.ajax({
            type: "GET",
            url: "{{ route('faktur.get-faktur-id', ':no_faktur') }}".replace(':no_faktur', $(this).val()),
            success: function (response) {
                $.each(response[0].detail_pembelian, function(index, option) {
                    $('#nama_obat').append('<option value="' + option.obat.id + '" data-id="' + option.obat.id + '" data-price="' + option.obat.harga + '" data-jumlah="' + option.jumlah + '">' + option.obat.nama_obat + '</option>');
            });
            }
        })
    });

    $('#nama_obat').on('change', function() {
        $('#harga').val($(this).find(':selected').data('price'));
        $('#jumlah').attr('max', $(this).find(':selected').data('jumlah'));
        $('#jumlah').val(1);
    });

});

    

</script>