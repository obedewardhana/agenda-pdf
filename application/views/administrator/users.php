<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Users</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Users</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <?php if ($dataAdmin->role == 'admin') { ?>
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-show-add" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> Tambah User</button>
            </div>
        <?php } else if ($dataAdmin->role == 'user') { ?>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:10%">#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <?php if ($dataAdmin->role == 'admin') { ?>
                                <th>Aksi</th>
                            <?php } else if ($dataAdmin->role == 'user') { ?>
                            <?php } ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="previewimg" data-index="">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Preview Foto</h5>
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
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="userfile" accept="image/gif, image/jpeg, image/jpg, image/png" class="dropify" data-default-file="" value="" />
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" autocomplete="off" class="form-control no-space" id="username">
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" autocomplete="off" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label>Email User</label>
                        <input type="email" name="email" autocomplete="off" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label>Role </label>
                        <select name="role" autocomplete="false" class="form-control" id="role">
                            <option value="" disabled>-Pilih-</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" autocomplete="off" name="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Konfirmasi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-del-confirm">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".btn-show-add").on("click", function() {
        jQuery("input[name=username]").val("");
        jQuery("input[name=name]").val("");
        jQuery("input[name=email]").val("");
        jQuery("select[name=role]").val("");
        jQuery("input[name=password]").val("");
        jQuery('.dropify-wrapper').find('.img-fit').remove();
        jQuery(".dropify").attr('data-default-file', '');
        jQuery("#compose .modal-title").html("Tambah User");
        jQuery("#composeForm").attr("action", "<?= base_url("users/insert"); ?>");

        var htmlpassword = '<div class="form-group"> ' +
            '<label>Password</label>' +
            '<input type="password" autocomplete="off" name="password" class="form-control" id="password">' +
            '</div>';
        jQuery("input[name=password]").closest('.form-group').find('label').remove();
        jQuery('.form-group').last().html(htmlpassword);
        jQuery(".dropify-clear").trigger("click");
    });

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("Users/json"); ?>"
        }
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

    $(".no-space").on({
        keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
        }
    });

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File size must be less than {0} MB');

    $("#composeForm").validate({
        rules: {
            userfile: {
                filesize: 1
            },
            username: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            role: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            userfile: {
                filesize: "Maksimal size gambar 1MB"
            },
            username: {
                required: "*Masukkan username."
            },
            name: {
                required: "*Masukkan nama lengkap."
            },
            email: {
                required: "*Masukkan email.",
                email: "*Email harus valid."
            },
            role: {
                required: "*Masukkan role."
            },
            password: {
                required: "*Masukkan password.",
                minlength: "*Minimal password 6 karakter."
            }
        },
        submitHandler: function(form) {
            var form = new FormData();
            form.append("username", jQuery('input[name=username]').val());
            form.append("name", jQuery('input[name=name]').val());
            form.append("email", jQuery('input[name=email]').val());
            form.append("userfile", jQuery('.dropify')[0].files[0]);
            form.append("role", jQuery('select[name=role]').val());
            form.append("password", jQuery('input[name=password]').val());
            var action = jQuery("#composeForm").attr("action");
            jQuery('.dropify-wrapper').find('.img-fit').remove();

            console.log(jQuery('.dropify')[0].files[0]);

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        jQuery("input[name=username]").val("");
                        jQuery("input[name=name]").val("");
                        jQuery("input[name=email]").val("");
                        jQuery("input[name=password]").val("");
                        jQuery("input[name=userfile]").val("");
                        jQuery(".dropify-clear").trigger("click");
                        jQuery("select[name=role]").val("");

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
        },
        errorPlacement: function(label, element) {
            label.addClass('error');
            element.after(label);
        }
    });

    $('body').on("click", ".btn-delete", function() {
        var id = jQuery(this).attr("data-id");
        var name = jQuery(this).attr("data-name");
        jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + name + "</b>");
        jQuery("#delete").modal("toggle");

        jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
    })

    function deleteData(id) {
        jQuery.getJSON("<?= base_url(); ?>users/delete/" + id, function(data) {
            console.log(data.status);
            if (data.status) {
                jQuery("#delete").modal("toggle");
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
        })
    }

    $("body").on("click", ".btn-edit", function() {
        jQuery(".dropify-clear").trigger("click");
        jQuery('.dropify-wrapper').find('.img-fit').remove();

        var id = jQuery(this).attr("data-id");
        var username = jQuery(this).attr("data-username");
        var role = jQuery(this).attr("data-role");
        var name = jQuery(this).attr("data-name");
        var email = jQuery(this).attr("data-email");
        var photo = jQuery(this).attr("data-photo");
        var password = jQuery(this).attr("data-password");

        if (photo == '') {
            var url = '<?= base_url(); ?>img/';
            var defaultpic = 'default.png';
            var newurl = url + '' + defaultpic;
            var html = '<img src="' + newurl + '" />';
        } else {
            var url = '<?= base_url(); ?>img/';
            var newurl = url + '' + photo;

            var img = '<img src=' + newurl + '></img>'
        }

        jQuery("#compose .modal-title").html("Edit User");
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>users/update/" + id);
        jQuery("input[name=username]").val(username);
        jQuery("input[name=name]").val(name);
        jQuery("input[name=email]").val(email);
        jQuery("select[name=role]").val(role);

        var html = '<img class="img-fit" src="' + newurl + '" />';
        jQuery('.dropify-wrapper').find('.dropify-message').before(html);

        jQuery("input[name=password]").attr('type', 'hidden');
        jQuery("input[name=password]").closest('.form-group').find('label').remove();
        jQuery("input[name=password]").prop('required', false);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });

    $('.dropify').dropify();
</script>