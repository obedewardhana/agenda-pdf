        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pengaturan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Pengaturan</li>
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
                                <label>Logo</label>
                                <input type="file" name="userfile" class="dropify" data-default-file="<?= base_url(); ?>img/<?= $this->company_info->get_company_logo(); ?>" value="<?= $this->company_info->get_company_logo(); ?>" />
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="<?= $this->company_info->get_company_name(); ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control"><?= $this->company_info->get_company_address(); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?= $this->company_info->get_company_email(); ?>">
                            </div>
                            <div class="form-group">
                                <label>No. Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" value="<?= $this->company_info->get_company_whatsapp(); ?>">
                            </div>
                            <div class="form-group">
                                <label>Link Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="<?= $this->company_info->get_company_facebook(); ?>">
                            </div>
                            <div class="form-group">
                                <label>Link Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="<?= $this->company_info->get_company_instagram(); ?>">
                            </div>
                            <div class="form-group">
                                <label>Link Youtube</label>
                                <input type="text" name="youtube" class="form-control" value="<?= $this->company_info->get_company_youtube(); ?>">
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
                form.append("address", jQuery('textarea[name=address]').val());
                form.append("email", jQuery('input[name=email]').val());
                form.append("whatsapp", jQuery('input[name=whatsapp]').val());
                form.append("facebook", jQuery('input[name=facebook]').val());
                form.append("instagram", jQuery('input[name=instagram]').val());
                form.append("youtube", jQuery('input[name=youtube]').val());
                form.append("userfile", jQuery('.dropify')[0].files[0]);
                jQuery.ajax({
                    url: "<?= base_url("setting/save_info"); ?>",
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