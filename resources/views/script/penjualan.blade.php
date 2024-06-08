<script>

    $(document).ready(function() {
        $('#penjualan_table').DataTable();
    });

    $('#obat').on("change",function () { 
        let price = $('#obat option:selected').data('price');
        $('#harga').val(price);
        $('#jumlah').on("change",function () {
            let total = price * $('#jumlah').val();
            $('#nama_akun').val('{{ Auth::user()->name }}');
            $('#total').val(total);
        })
    });

    // $('#tombol-tambah').click(function () { 
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('penjualan.store') }}",
    //         data: "data",
    //         dataType: "dataType",
    //         success: function (response) {
                
    //         }
    //     });
        
    // });

</script>