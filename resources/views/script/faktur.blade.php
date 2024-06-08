<script>
    $(document).ready(function() {
        let table = $('#faktur_table').DataTable();


        $(document).on('click', '#faktur_table tbody tr button', function() {
        
        let obat = $(this).data('obat');
        let total = 0;

        $('#detail_table tbody').empty();


        obat.detail_pembelian.forEach(function(item) {
                $('#detail_table tbody').append(
                    '<tr>' +
                    '<td>' + item.obat.nama_obat + '</td>' +
                    '<td>' + item.harga + '</td>' +
                    '<td>' + item.jumlah + '</td>' +
                    '<td>' + item.diskon + '%</td>' +
                    '<td>' + item.subtotal + '</td>' +
                    '</tr>'
                );
                total += item.subtotal
            });
            $('#detail_table tbody').append(
                '<tr>' +
                '<td colspan="4" align="right">Total</td>' +
                '<td>' + total + '</td>' +
                '</tr>'
            );
        $("#modalpembelian").modal("show");
      });

      $(document).on('click', '#faktur_table tbody tr buttons', function() {
        let no_faktur = $(this).data('faktur');
        let status = $(this).data('status');
        if(status == 1) {
            alert('Faktur ini sudah lunas');
        }else{
            if(confirm('Apakah anda yakin ingin melunasi faktur ini?') == true) {
            $.ajax({
                type: "POST",
                url: "{{ route('faktur.update-status') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_faktur: no_faktur
                },
                success: function(response) {
                    window.location.href = "{{ route('faktur.index') }}";
                }
            });
        }
        }
    }
    );

});

</script>