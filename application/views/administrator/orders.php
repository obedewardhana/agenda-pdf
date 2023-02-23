<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Orders</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Orders</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bukti Transfer</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama pembeli</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="details" data-index="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-detail">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td><span class="total"></span></td>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table table-borderless" id="table-info">
                        <tbody>
                            <tr>
                                <td>Alamat</td>
                                <td><span class="address"></span></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="status"></span></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td><span class="paymentdate"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="previewimg" data-index="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Preview Bukti Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-box text-center">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="compose" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Ubah Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="compose-form">
                    <div class="form-group">
                        <label>Status :</label>
                        <select name="status" class="form-control" id="status">
                            <option value="" disabled>-Pilih-</option>
                            <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                            <option value="Dalam review">Dalam review</option>
                            <option value="Lunas">Lunas</option>
                            <option value="Gagal">Gagal </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-submit">Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
    .table-img img {
        height: 100px;
        width: 100px;
        object-fit: cover;
        object-position: center;
    }

    .btn-previewimg {
        background: transparent;
        border: none;
        margin: 0;
        padding: 0;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
        cursor: pointer;
        opacity: 0.7;
    }

    .btn-previewimg:hover {
        opacity: 1;
    }

    span.address {
        text-transform: capitalize;
    }
</style>

<script>
    $("#table-detail").DataTable({
        autoWidth: false,
        info: false,
        filter: false,
        lengthChange: false,
        paging: false
    });

    $("body").on("click", ".btn-view", function() {
        var id = jQuery(this).attr("data-id");
        var paymentdate = jQuery(this).attr("data-paymentdate");

        jQuery.getJSON("<?= base_url("orders/detail"); ?>/" + id, function(data) {

            jQuery("#table-detail").DataTable().clear();

            data.items.forEach(function(item, index) {
                var tmp = [];
                var sub = item.price * item.qty;
                tmp.push(index + 1);
                tmp.push(item.name);
                tmp.push("Rp " + item.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
                tmp.push(item.qty);
                tmp.push("Rp " + sub.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
                // tmp.push(item.customeraddress);

                jQuery("#table-detail").DataTable().row.add(tmp).draw();
            })

            jQuery("#table-detail .total").html("Rp " + data.total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            jQuery("#table-info .address").html(': '+data.customeraddress.toString());
            jQuery("#table-info .status").html(': '+data.status);
            if (paymentdate == '') {

            } else {
                jQuery("#table-info .paymentdate").html(': '+paymentdate);
            }

            jQuery("#details").modal("toggle");
        });
    });

    $("body").on("click", ".btn-previewimg", function() {
        var id = jQuery(this).attr("data-id");
        var photo = jQuery(this).attr("data-photo");
        var url = '<?= base_url(); ?>img/';
        var newurl = url + '' + photo;
        var html = '<img src="' + newurl + '" />';

        if (photo == '') {
            var defaultpic = 'default.png';
            var newurl = url + '' + defaultpic;
            var html = '<img src="' + newurl + '" />';
            jQuery("#previewimg").modal("toggle");
            jQuery('#previewimg').find('.img-box').empty();
            jQuery('#previewimg').find('.img-box').append(html);
        } else {
            jQuery("#previewimg").modal("toggle");
            jQuery('#previewimg').find('.img-box').empty();
            jQuery('#previewimg').find('.img-box').append(html);
        }
    });

    $("body").on("click", ".btn-edit", function() {
        var id = jQuery(this).attr("data-id");
        var status = jQuery(this).attr("data-status");

        jQuery("#compose .modal-title").html("Determine status");
        jQuery("#compose-form").attr("action", "<?= base_url(); ?>orders/update/" + id);
        jQuery("#status").val();
        // jQuery("select[name=status]").val(status);
        jQuery("#status").val(status);

        jQuery("#compose").modal("toggle");
    });

    $('.btn-submit').on("click", function() {
        var form = new FormData();
        form.append("status", jQuery('select[name=status]').val());
        var action = jQuery("#compose-form").attr("action");

        jQuery.ajax({
            url: action,
            method: "POST",
            data: form,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status) {
                    jQuery("#status").val(status);

                    jQuery("#compose").modal('toggle');
                    jQuery("#data").DataTable().ajax.reload(null, true);
                    Swal.fire(
                        'Berhasil',
                        data.msg,
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Gagal',
                        data.msg,
                        'error'
                    )
                }
            }
        });
    });

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [
            [0, "desc"]
        ],
        "ajax": {
            "url": "<?= base_url("orders/json"); ?>"
        }
    });
</script>