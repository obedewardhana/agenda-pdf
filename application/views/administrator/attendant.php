<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Attendants</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Attendants</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <?php if ($dataAdmin->role == 'admin') { ?>
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-show-add mr-2" data-toggle="modal" data-target="#compose"><i class="fa fa-plus-square"></i> Tambah Attendant</button>
                <button class="btn btn-danger btn-sm btn-show-pdf mr-2" data-toggle="modal" data-target="#composePDF"><i class="fa fa-plus-square"></i> Upload Pdf</button>
                <button class="btn btn-primary btn-sm btn-show-word mr-2" data-toggle="modal" data-target="#composeWORD"><i class="fa fa-plus-square"></i> Upload Word</button>
                <div class="w-100 pt-3 pb-3 d-flex">
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/attendant/attendant-sample-pdf.pdf"); ?>"><i class="fa fa-file mr-1"></i>Format Pdf</a>
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/attendant/attendant-sample-word.docx"); ?>"><i class="fa fa-file mr-1"></i>Format Word</a>
                </div>
            </div>
        <?php } else if ($dataAdmin->role == 'user') { ?>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:10%">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Invitation</th>
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


<div class="modal" id="compose" tabindex="-1" phone="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" phone="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah Attendant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" autocomplete="off" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label>Email User</label>
                        <input type="email" name="email" autocomplete="off" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" autocomplete="off" name="phone" class="form-control no-space" id="phone" onkeypress="return isNumber(event)">
                    </div>                    
                    <div class="form-group">
                        <label>Invitation</label>
                        <select name="invitation" autocomplete="false" class="form-control" id="invitation">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach($dataInv as $opt){?>
                            <option value="<?= $opt->id;?>" data-title="<?= $opt->title;?>"><?= $opt->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary btn-submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="composePDF" tabindex="-1" phone="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" phone="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Upload PDF Attendant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeFormPdf">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" accept="application/pdf" name="filePdf" class="" id="filePdf">
                    </div>
                    <div class="form-group">
                        <label>Invitation</label>
                        <select name="invpdf" autocomplete="false" class="form-control" id="inv">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach($dataInv as $opt){?>
                            <option value="<?= $opt->id;?>" data-title="<?= $opt->title;?>"><?= $opt->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit" id="btn-pdf-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="composeWORD" tabindex="-1" phone="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" phone="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Upload Doc Attendant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeFormWord">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="fileWord" class="" id="fileWord" onchange="word2html(this)">
                    </div>
                    <div class="form-group">
                        <label>Invitation</label>
                        <select name="invword" autocomplete="false" class="form-control" id="invword">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach($dataInv as $opt){?>
                            <option value="<?= $opt->id;?>" data-title="<?= $opt->title;?>"><?= $opt->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="word-result">
                        <pre></pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit" id="btn-word-submit">Simpan</button>
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
        jQuery("input[name=name]").val("");
        jQuery("input[name=email]").val("");
        jQuery("input[name=phone]").val("");
        jQuery("select[name=invitation]").val("");
        jQuery("#compose .modal-title").html("Tambah Attendant");
        jQuery("#composeForm").attr("action", "<?= base_url("attendant/insert"); ?>");
        jQuery("#composeForm").validate().resetForm();
    });

    $(".btn-show-pdf").on("click", function() {
        jQuery("input[name=filePdf]").val("");
        jQuery("select[name=invpdf]").val("");
        jQuery("#composeFormPdf").attr("action", "<?= base_url("attendant/insert_bulk"); ?>");
        jQuery("#composeFormPdf").validate().resetForm();
        jQuery("#btn-pdf-submit").prop('disabled', true);
        nameArr = [];
        emailArr = [];
        phoneArr = [];
        tablesArr = [];
    });

    $(".btn-show-word").on("click", function() {
        jQuery("input[name=fileWord]").val("");
        jQuery("select[name=invword]").val("");
        jQuery("#composeFormWord").attr("action", "<?= base_url("attendant/insert_bulk"); ?>");
        jQuery("#composeFormWord").validate().resetForm();
        jQuery("#word-result").empty();
        nameArr = [];
        emailArr = [];
        phoneArr = [];
        tablesArr = [];
    });

    var nameArr = [];
    var emailArr = [];
    var phoneArr = [];
    var tablesArr = [];

    function handleFile(e) {
        const btnPdf = document.getElementById("btn-pdf-submit");
        btnPdf.textContent = "Transfering file...";
        var files = e.target.files;
        var f = files[0];
        {
            var reader = new FileReader();
            var name = f.name;
            reader.onload = function(e) {
                var data = e.target.result;
                btnPdf.textContent = "Parsing PDF...";
                parse_content(data); //btoa(arr));
            };
            reader.readAsArrayBuffer(f);
        }
    }

    document.getElementById('filePdf').addEventListener('change', handleFile, false);


    pdf_table_extractor_progress = function(result) {
        const btnPdf = document.getElementById("btn-pdf-submit");
        btnPdf.textContent = "Parsing PDF, progress: " + result.currentPages + " / " + result.numPages + " pages";
        btnPdf.textContent = "Simpan";
        btnPdf.disabled = false;
    };

    var parse_content = function(content) {
        var url = window.location.origin;
        var nama_direktori = url + '/agenda-pdf/assets/pdfextractor/pdf.worker.js';
        pdfjsLib.GlobalWorkerOptions.workerSrc = nama_direktori;
        pdfjsLib.cMapUrl = 'https://mozilla.github.io/pdf.js/web/cmaps/';
        pdfjsLib.cMapPacked = true;

        var loadingTask = pdfjsLib.getDocument(content);

        loadingTask.promise.then(pdf_table_extractor).then(function(result) {
            page_tables = result.pageTables.shift();
            tables = page_tables.tables.slice(1);

            phoneArr.push(phone);
            tablesArr.push(tables);
            // document.getElementById('btn-pdf-submit').innerText = JSON.stringify(tables);
            // console.log(Object.keys(tables).length);
            // console.log(tablesArr.map(x => x.map(a => a[0])).flat(2).filter(e => e.length));
        });

    };

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("Attendant/json"); ?>"
        }
    });

    $('select[name="invitation"]').on('change',function(){
        $(this).find('option').removeClass('selected');
        if($(this).find('option').val() == $(this).val()){
            $(this).addClass('selected');
        }
    });


    $("#composeForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                maxlength: 13
            },
            invitation: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "*Masukkan nama lengkap."
            },
            email: {
                required: "*Masukkan email.",
                email: "*Email harus valid."
            },
            phone: {
                required: "*Masukkan phone.",
                maxlength: "*Maksimal 13 digit."
            },
            invitation: {
                required: "*Masukkan undangan."
            }
        },
        submitHandler: function(form) {
            var form = new FormData();
            form.append("name", jQuery('input[name=name]').val());
            form.append("email", jQuery('input[name=email]').val());
            form.append("phone", jQuery('input[name=phone]').val());
            form.append("invitation", jQuery('select[name=invitation]').val());
            form.append("invitation_title", jQuery('select[name=invitation]').find(":selected").data('title'));
            var action = jQuery("#composeForm").attr("action");

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        jQuery("input[name=name]").val("");
                        jQuery("input[name=email]").val("");
                        jQuery("input[name=phone]").val("");
                        jQuery("select[name=invitation]").val("");
                        jQuery("select[name=invitation]").attr("data-title","");

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

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File size must be less than {0} MB');

    $("#composeFormPdf").validate({
        rules: {
            filePdf: {
                required: true,
                filesize: 1
            },
            invpdf: {
                required: true
            }
        },
        messages: {
            filePdf: {
                required: "*Unggah data pdf anda.",
                filesize: "*Maksimal ukuran file adalah 1MB"
            },
            invpdf: {
                required: "*Pilih Undangan."
            },
        },
        submitHandler: function(form) {
            var name = tablesArr.map(x => x.map(a => a[0])).flat(2).filter(e => e.length);
            var email = tablesArr.map(x => x.map(a => a[1])).flat(2).filter(e => e.length);
            var phone = tablesArr.map(x => x.map(a => a[2])).flat(2).filter(e => e.length);    
            var count = tablesArr.map(x => x.map(a => a[0])).flat(2).length;
            var inv = jQuery('select[name=invpdf]').val();
            var invtitle = jQuery('select[name=invpdf]').find(":selected").data('title');

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("name[]", name[i]);
                form.append("email[]", email[i]);
                form.append("phone[]", phone[i]);
                form.append("invitation[]", inv);
                form.append("invitation_title[]", invtitle);
            }

            var action = jQuery("#composeFormPdf").attr("action");

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        jQuery("select[name=invpdf]").val("");
                        jQuery("select[name=invpdf]").attr("data-title","");
                        jQuery("#composePDF").modal('toggle');
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

    function word2html(input) {
        require("docx2html")(input.files[0], {
                container: document.querySelector("#word-result")
            })
            .then(html => {
                const tableres = document.querySelector(".TableNormal");
                tableres.setAttribute("id", "wordTable");
                const wordTable = document.getElementById("wordTable");

                // first row needs to be headers
                var headers = [];
                for (var i = 0; i < wordTable.rows[0].cells.length; i++) {
                    headers[i] = wordTable.rows[0].cells[i].innerHTML.toLowerCase().replace(/(<([^>]+)>)/gi, "");
                }

                // go through cells
                for (var i = 1; i < wordTable.rows.length; i++) {

                    var tableRow = wordTable.rows[i];
                    var rowData = {};

                    for (var j = 0; j < tableRow.cells.length; j++) {

                        rowData[headers[j]] = tableRow.cells[j].innerHTML.replace(/(<([^>]+)>)/gi, "");

                    }

                    tablesArr.push(rowData);
                }

                console.log(tablesArr);
                // console.log(tablesArr.map(x=> x.email));

                return JSON.stringify(tablesArr);


            });
    }

    $("#composeFormWord").validate({
        rules: {
            fileWord: {
                required: true,
                filesize: 1
            },
            invword: {
                required: true,
            }
        },
        messages: {
            fileWord: {
                required: "*Unggah data word anda.",
                filesize: "*Maksimal ukuran file adalah 1MB"
            },
            invword: {
                required: "Pilih Undangan."
            },
        },
        submitHandler: function(form) {

            var name = tablesArr.map(x => x.name)
            var email = tablesArr.map(x => x.email)
            var phone = tablesArr.map(x => x.phone)
            var count = tablesArr.map(x => x.name).length;
            var invw = jQuery('select[name=invword]').val();
            var invwt = jQuery('select[name=invword]').find(":selected").data('title')

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("name[]", name[i]);
                form.append("email[]", email[i]);
                form.append("phone[]", phone[i]);
                form.append("invitation[]", invw);
                form.append("invitation_title[]", invwt);
            }

            var action = jQuery("#composeFormWord").attr("action");

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        jQuery("select[name=invword]").val("");
                        jQuery("select[name=invword]").attr("data-title","");
                        jQuery("#composeWORD").modal('toggle');
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
        jQuery.getJSON("<?= base_url(); ?>attendant/delete/" + id, function(data) {
            // console.log(data.status);
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

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    $("body").on("click", ".btn-edit", function() {
        jQuery(".dropify-clear").trigger("click");
        jQuery('.dropify-wrapper').find('.img-fit').remove();

        var id = jQuery(this).attr("data-id");
        var phone = jQuery(this).attr("data-phone");
        var name = jQuery(this).attr("data-name");
        var email = jQuery(this).attr("data-email");
        var invitation = jQuery(this).attr("data-invitation");
        var invitationtitle = jQuery(this).attr("data-invtitle");


        jQuery("#compose .modal-title").html("Edit Hadirin");
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>attendant/update/" + id);
        jQuery("input[name=name]").val(name);
        jQuery("input[name=email]").val(email);
        jQuery("input[name=phone]").val(phone);
        jQuery("select[name=invitation]").val(invitation);
        jQuery("select[name=invitation]").attr("data-title",invitationtitle);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });
</script>