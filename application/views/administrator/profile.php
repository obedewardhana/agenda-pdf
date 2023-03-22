<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Profile</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file" name="userfile" class="dropify" data-default-file="<?= base_url(); ?>img/<?= $dataAdmin->photo; ?>" value="<?= $this->company_info->get_company_logo(); ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="<?= $dataAdmin->name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $dataAdmin->email; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-primary btn-save">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".btn-save").on("click", function() {
        var form = new FormData();
        form.append("name", jQuery('input[name=name]').val());
        form.append("email", jQuery('input[name=email]').val());
        form.append("userfile", jQuery('.dropify')[0].files[0]);
        jQuery.ajax({
            url: "<?= base_url("setting/save_profile"); ?>",
            method: "POST",
            data: form,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status) {
                    Swal.fire(
                        'Berhasil',
                        data.msg,
                        'success'
                    ).then((result) => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire(
                        'Gagal',
                        data.msg,
                        'error'
                    )
                }

            }
        });
    })

    $('.dropify').dropify();
</script>