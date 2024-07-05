<script>
    let data = [];
    let total = 0;
    let diskon = 0;

    $(document).ready(function() {
        table = $('#pembelian_table').DataTable({
            data: data,
            columns: [
                {data: 'supplier'},
                {data: 'id_obat', visible: false},
                {data: 'nama_obat'},
                {data: 'harga'},
                {data: 'jumlah'},
                {data: 'diskon'},
                {data: 'subtotal'},
            ],
            columnDefs: [
                {
                    target: 2,
                    visible: false,
                    searchable: false
                }
            ],
            footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(6)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(6).footer()).html('Total: ' + total);
        }
        });

    });

    $('#jumlah').on("change",function () {
        diskon = revertToInt($('#harga').val()) * ($('#diskon').val() / 100);
        total = (revertToInt($('#harga').val()) - diskon) *  $('#jumlah').val();
        $('#total').val(formatRupiah(total.toString(), 'Rp. '));
    })

    $('#harga').on("change",function () {
        diskon = revertToInt($('#harga').val()) * ($('#diskon').val() / 100);
        total = (revertToInt($('#harga').val()) - diskon) *  $('#jumlah').val();
        $('#total').val(formatRupiah(total.toString(), 'Rp. '));
    })

    $('#diskon').on("change",function () {
        diskon = revertToInt($('#harga').val()) * ($('#diskon').val() / 100);
        total = (revertToInt($('#harga').val()) - diskon) *  $('#jumlah').val();
        $('#total').val(formatRupiah(total.toString(), 'Rp. '));
    })

    function addrow(supplier, id_obat, nama_obat, harga, jumlah, diskon, total) {
        data.push({
            supplier: supplier,
            id_obat: id_obat,
            nama_obat: nama_obat,
            harga: harga,
            jumlah: jumlah,
            diskon: diskon,
            subtotal: total
        });
        table.clear().rows.add(data).draw();
    }

    function validation() {
        if($('#no_faktur').val() == '') {
            alert('No. Faktur Harus Diisi');
            return false;
        }else if($('#supplier').val() == '') {
            alert('Supplier Harus Diisi');
            return false;
        }else if($('#tgl_transaksi').val() == '') {
            alert('Tgl. Transaksi Harus Diisi');
            return false;
        }else if($('#jatuh_tempo').val() == '') {
            alert('Jatuh Tempo Harus Diisi');
            return false;
        }else if($('#jatuh_tempo').val() < $('#tgl_transaksi').val()) {
            alert('Jatuh Tempo Harus Lebih Besar Dari Tgl. Transaksi');
            return false;
        }else if($('#nama_obat option:selected').val() == '') {
            alert('Obat Harus Diisi');
            return false;
        }else if($('#harga').val() == '') {
            alert('Harga Harus Diisi');
            return false;
        }else if($('#jumlah').val() == '') {
            alert('Jumlah Harus Diisi');
            return false;
        }else{
            return true;
        }
        
    }

    $('#tombol-tambah').click(function() {
        if(validation() == false) return false;
        let supplier = $('#supplier option:selected').text();
        let nama_obat = $('#nama_obat option:selected').text();
        let id_obat = $('#nama_obat option:selected').val();
        let harga = revertToInt($('#harga').val());
        let jumlah = $('#jumlah').val();
        let diskon = $('#diskon').val();
        if(diskon == '') diskon = 0;
        let subtotal = revertToInt($('#total').val());
        $('#supplier').prop('disabled', true);
        $('#no_faktur').prop('disabled', true);
        $('#tgl_transaksi').prop('disabled', true);
        $('#jatuh_tempo').prop('disabled', true);
        $('#diskon_faktur').prop('disabled', true);
        addrow(supplier, id_obat, nama_obat, harga, jumlah, diskon, subtotal);
        });

    $('#tombol-simpan').click(function() {
        let tabledata = table.rows().data().toArray();
        let no_faktur = $('#no_faktur').val();
        let tgl_transaksi = $('#tgl_transaksi').val();
        let jatuh_tempo = $('#jatuh_tempo').val();
        let id_supplier = $('#supplier option:selected').val();
        let diskon_faktur = $('#diskon_faktur').val();
        let totals = total;
        let formdata = {
            no_faktur: no_faktur,
            id_supplier: id_supplier,
            table_data: tabledata,
            tgl_transaksi: tgl_transaksi,
            jatuh_tempo: jatuh_tempo,
            diskon: diskon_faktur,
            total: totals,
        };
        $.ajax({
            type: "POST",
            url: "{{ route('pembelian.store') }}",
            datatype: 'JSON',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            success: function(response) {
            window.location.href = "{{ route('pembelian.index') }}";
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
                })
    });


    $('#harga').on("keyup",function () {
        $('#harga').val(formatRupiah(this.value, 'Rp. '));
    });

    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function revertToInt(rupiahString) {
    var cleanNumberString = rupiahString.replace(/^Rp\s?|\./g, '');

    var intValue = parseInt(cleanNumberString);

    return intValue;
}

</script>