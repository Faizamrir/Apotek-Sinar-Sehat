<script>

let data = [];
let total = 0;
    $(document).ready(function() {
        table = $('#penjualan_table').DataTable({
            data: data,
            columns: [
                {data: 'id_obat', visible: false},
                {data: 'nama_obat'},
                {data: 'harga'},
                {data: 'jumlah'},
                {data: 'subtotal'},
            ],
            columnDefs: [
                {
                    target: 1,
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
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html('Total: ' + total);
            $('#total').val(formatRupiah(total.toString(), 'Rp. '));
        }
        });
    });

    $('#harga, #obat').on("change",function () {
        $('#subtotal').val(formatRupiah((revertToInt($('#harga').val()) * $('#jumlah').val()).toString(), 'Rp. '));
    });

    $('#obat').on("change",function () { 
        let price = $('#obat option:selected').data('price');
        $('#harga').val(formatRupiah(price.toString(), 'Rp. '));
        $('#jumlah, #obat').on("change",function () {
            let total = price * $('#jumlah').val();
            $('#subtotal').val(formatRupiah(total.toString(), 'Rp. '));
        })
    });

    function validation_stok() {
        if($('#obat option:selected').data('stok') < $('#jumlah').val()) {
            alert('Stok Tidak Cukup');
            return false;
        } else {
            return true;
        }
    }
    

    function validation() {
        if($('#obat option:selected').val() == 0) {
            alert('Obat Harus Diisi');
            return false;
        } else if($('#jumlah').val() == 0) {
            alert('Jumlah Harus Diisi');
            return false;
        } else {
            return true;
        }
    }

    function validation_bayar() {
        if($('#uang_bayar').val() == 0) {
            alert('Uang Bayar Harus Diisi');
            return false;
        } else if(revertToInt($('#uang_bayar').val()) < total) {
            alert('Uang Bayar Harus Lebih Besar Dari Total Bayar');
            return false;
        } else {
            return true;
        }
    }

    function validation_table() {
        if(data.length == 0) {
            alert('Tidak Ada Obat Yang Di Beli');
            return false;
        } else {
            return true;
        }
    }

    $('#tombol-simpan').click(function () {
        if(validation_table() == false) return false;
        if(validation_bayar() == false) return false;
        let uang_bayar = revertToInt($('#uang_bayar').val());
        let total = revertToInt($('#total').val());
        let uang_kembali = revertToInt($('#uang_kembali').val());
        let tableData = table.rows().data().toArray();
        let formdata = {
            table_data: tableData,
            total: total,
            uang_bayar: uang_bayar,
            uang_kembali: uang_kembali
        };
        console.log(formdata);
        $.ajax({
            type: "POST",
            url: "{{ route('penjualan.store') }}",
            datatype: 'JSON',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            success: function(response) {
            window.location.href = "{{ route('penjualan.index') }}";
            },
            // error: function(xhr, status, error) {
            //     console.error(xhr.responseText);
            // }
        });
    });

    $('#tombol-tambah').click(function () {
        if(validation() == false) return false;
        if(validation_stok() == false) return false;
        let obat = $('#obat option:selected').text();
        let id = $('#obat option:selected').data('id');
        let price = $('#obat option:selected').data('price');
        let qty = $('#jumlah').val();
        let subtotal = revertToInt($('#subtotal').val());
        addrow(id, obat, price, qty, subtotal);
        $('#jumlah').val(0);
        $('#subtotal').val(0);
        $('#uang_bayar').removeAttr('readonly');
    });

    function addrow(id_obat, nama_obat, harga, jumlah, subtotal) {
        data.push({
            id_obat: id_obat,
            nama_obat: nama_obat,
            harga: harga,
            jumlah: jumlah,
            subtotal: subtotal,
        });
        table.clear().rows.add(data).draw();
    }

    $('#uang_bayar').on("change",function () {
        total_bayar = revertToInt($('#uang_bayar').val());
        $('#uang_bayar').val(formatRupiah($('#uang_bayar').val().toString(), 'Rp. '));
        $('#uang_kembali').val(formatRupiah((revertToInt($('#uang_bayar').val()) - total).toString(), 'Rp. '));
    })

    // function formatRupiah(angka, prefix)
    // {
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //         split    = number_string.split(','),
    //         sisa     = split[0].length % 3,
    //         rupiah     = split[0].substr(0, sisa),
    //         ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
    //     if (ribuan) {
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }
        
    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }

    function formatRupiah(angka, prefix) {
    // Remove non-digit characters except comma and decimal point
    var number_string = angka.replace(/[^,\d.-]/g, '').toString();

    // Split the number into integer and decimal parts
    var split = number_string.split('.');
    var integerPart = split[0];
    var decimalPart = split.length > 1 ? ',' + split[1] : '';

    // Handle negative sign
    var isNegative = false;
    if (integerPart.charAt(0) === '-') {
        isNegative = true;
        integerPart = integerPart.substring(1);
    }

    // Format the integer part with thousands separator
    var sisa = integerPart.length % 3;
    var rupiah = sisa > 0 ? integerPart.substr(0, sisa) : '';
    var ribuan = integerPart.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    // Add negative sign back if the number was negative
    rupiah = isNegative ? '-Rp.' + rupiah : 'Rp.' + rupiah;

    // Combine integer part and decimal part
    rupiah = decimalPart ? rupiah + decimalPart : rupiah;

    // Add prefix 'Rp. ' if specified
    return prefix === undefined ? rupiah : (rupiah ? rupiah : '');
}

//     function revertToInt(rupiahString) {
//     var cleanNumberString = rupiahString.replace(/^Rp\s?|\./g, '');

//     var intValue = parseInt(cleanNumberString);

//     return intValue;
// }

function revertToInt(rupiahString) {
    // Remove 'Rp' and all dots (thousand separators)
    var cleanNumberString = rupiahString.replace(/^Rp\s?|\./g, '');

    // Check if the number is negative
    var isNegative = false;
    if (cleanNumberString.charAt(0) === '-') {
        isNegative = true;
        cleanNumberString = cleanNumberString.substring(1);
    }

    // Parse the cleaned string into an integer
    var intValue = parseInt(cleanNumberString);

    // Make the integer negative if the original string was negative
    if (isNegative) {
        intValue = -intValue;
    }

    return intValue;
    }

</script>