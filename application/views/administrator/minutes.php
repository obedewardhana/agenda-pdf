<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Minutes</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Minutes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <?php if ($dataAdmin->role == 'admin') { ?>
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-show-add mr-2" data-toggle="modal" data-target="#compose"><i class="fa fa-plus-square"></i> Tambah Minutes</button>
                <button class="btn btn-danger btn-sm btn-show-pdf mr-2" data-toggle="modal" data-target="#composePDF"><i class="fa fa-plus-square"></i> Upload Pdf</button>
                <button class="btn btn-primary btn-sm btn-show-word mr-2" data-toggle="modal" data-target="#composeWORD"><i class="fa fa-plus-square"></i> Upload Word</button>
                <div class="w-100 pt-3 pb-3 d-flex">
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/minutes/minutes-sample-pdf.pdf"); ?>"><i class="fa fa-file mr-1"></i>Format Pdf</a>
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/minutes/minutes-sample-word.docx"); ?>"><i class="fa fa-file mr-1"></i>Format Word</a>
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
                            <th width="10%">Foto</th>
                            <th width="20%">Title</th>
                            <th width="30%">Agenda</th>
                            <th width="10%">Document</th>
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

<div class="modal" id="compose" tabindex="-1" phone="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" phone="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah Minutes</h5>
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
                        <label>Title</label>
                        <input type="text" name="title" autocomplete="off" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" autocomplete="off" class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Agenda</label>
                        <select name="agenda" autocomplete="false" class="form-control" id="agenda">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataAg as $opt) { ?>
                                <option value="<?= $opt->id; ?>" data-title="<?= $opt->title; ?>"><?= $opt->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Pendukung</label>
                        <input type="file" name="document" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" value="" />
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
                <h5 class="modal-title" id="largeModalLabel">Upload PDF Minutes</h5>
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
                        <label>Agenda</label>
                        <select name="agpdf" autocomplete="false" class="form-control" id="agpdf">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataAg as $opt) { ?>
                                <option value="<?= $opt->id; ?>" data-title="<?= $opt->title; ?>"><?= $opt->title; ?></option>
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
                <h5 class="modal-title" id="largeModalLabel">Upload Doc Minutes</h5>
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
                        <label>Agenda</label>
                        <select name="agword" autocomplete="false" class="form-control" id="agword">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataAg as $opt) { ?>
                                <option value="<?= $opt->id; ?>" data-title="<?= $opt->title; ?>"><?= $opt->title; ?></option>
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
        jQuery("input[name=title]").val("");
        jQuery("input[name=document]").val("");
        jQuery("textarea[name=description]").val("");
        jQuery("select[name=agenda]").val("");
        jQuery('.dropify-wrapper').find('.img-fit').remove();
        jQuery(".dropify").attr('data-default-file', '');
        jQuery("#compose .modal-title").html("Tambah Notulen");
        jQuery("#composeForm").attr("action", "<?= base_url("minutes/insert"); ?>");
        jQuery("#composeForm").validate().resetForm();
    });

    $(".btn-show-pdf").on("click", function() {
        jQuery("input[name=filePdf]").val("");
        jQuery("input[name=document]").val("");
        jQuery("select[name=agpdf]").val("");
        jQuery("#composeFormPdf").attr("action", "<?= base_url("minutes/insert_bulk"); ?>");
        jQuery("#composeFormPdf").validate().resetForm();
        jQuery("#btn-pdf-submit").prop('disabled', true);
        titleArr = [];
        descriptionArr = [];
        tablesArr = [];
    });

    $(".btn-show-word").on("click", function() {
        jQuery("input[name=fileWord]").val("");
        jQuery("input[name=document]").val("");
        jQuery("select[name=agword]").val("");
        jQuery("#composeFormWord").attr("action", "<?= base_url("minutes/insert_bulk"); ?>");
        jQuery("#composeFormWord").validate().resetForm();
        jQuery("#word-result").empty();
        titleArr = [];
        descriptionArr = [];
        tablesArr = [];
    });

    var titleArr = [];
    var descriptionArr = [];
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
            "url": "<?= base_url("minutes/json"); ?>"
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


    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File size must be less than {0} MB');


    $("#composeForm").validate({
        rules: {
            userfile: {
                filesize: 1
            },
            title: {
                required: true
            },
            description: {
                required: true
            },
            agenda: {
                required: true
            }
        },
        messages: {
            userfile: {
                filesize: "Maksimal size gambar 1MB"
            },
            title: {
                required: "*Masukkan title."
            },
            description: {
                required: "*Masukkan description.",
            },
            agenda: {
                required: "*Pilih Agenda."
            }
        },
        submitHandler: function(form) {
            var form = new FormData();
            form.append("title", jQuery('input[name=title]').val());
            form.append("description", jQuery('textarea[name=description]').val());
            form.append("agenda", jQuery('select[name=agenda]').val());
            form.append("agenda_title", jQuery('select[name=agenda]').find(":selected").data('title'));
            form.append("userfile", jQuery('.dropify')[0].files[0]);
            form.append("document", jQuery('input[name=document]')[0].files[0]);
            var action = jQuery("#composeForm").attr("action");
            jQuery('.dropify-wrapper').find('.img-fit').remove();

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        jQuery("input[name=title]").val("");
                        jQuery("textarea[name=description]").val("");
                        jQuery("select[name=agenda]").val("");
                        jQuery("select[name=agenda]").attr("data-title", "");
                        jQuery("input[name=userfile]").val("");
                        jQuery("input[name=document]").val("");
                        jQuery(".dropify-clear").trigger("click");

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

    $("#composeFormPdf").validate({
        rules: {
            filePdf: {
                required: true,
                filesize: 1
            },
            agpdf: {
                required: true
            }
        },
        messages: {
            filePdf: {
                required: "*Unggah data pdf anda.",
                filesize: "*Maksimal ukuran file adalah 1MB"
            },
            agpdf: {
                required: "*Pilih Agenda"
            }
        },
        submitHandler: function(form) {
            var title = tablesArr.map(x => x.map(a => a[0])).flat(2).filter(e => e.length);
            var description = tablesArr.map(x => x.map(a => a[1])).flat(2).filter(e => e.length);
            var count = tablesArr.map(x => x.map(a => a[0])).flat(2).length;
            var ag = jQuery('select[name=agpdf]').val();
            var agtitle = jQuery('select[name=agpdf]').find(":selected").data('title');

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("title[]", title[i]);
                form.append("description[]", description[i]);
                form.append("agenda[]", ag);
                form.append("agenda_title[]", agtitle);
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
            agword: {
                required: true
            }
        },
        messages: {
            fileWord: {
                required: "*Unggah data word anda.",
                filesize: "*Maksimal ukuran file adalah 1MB"
            },
            agword: {
                required: "*Pilih Agenda"
            }
        },
        submitHandler: function(form) {

            var title = tablesArr.map(x => x.title)
            var description = tablesArr.map(x => x.description)
            var count = tablesArr.map(x => x.name).length;
            var ag = jQuery('select[name=agword]').val();
            var agtitle = jQuery('select[name=agword]').find(":selected").data('title');

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("title[]", title[i]);
                form.append("description[]", description[i]);
                form.append("agenda[]", ag);
                form.append("agenda_title[]", agtitle);
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
        var title = jQuery(this).attr("data-title");
        jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + title + "</b>");
        jQuery("#delete").modal("toggle");

        jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
    })

    function deleteData(id) {
        jQuery.getJSON("<?= base_url(); ?>minutes/delete/" + id, function(data) {
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

        jQuery('.preview-document').html("");

        var id = jQuery(this).attr("data-id");
        var title = jQuery(this).attr("data-title");
        var description = jQuery(this).attr("data-description");
        var photo = jQuery(this).attr("data-photo");
        var document = jQuery(this).attr("data-document");
        var newdocument = document.substring(document.lastIndexOf("/") + 1);
        var agenda = jQuery(this).attr("data-agenda");
        var agendatitle = jQuery(this).attr("data-agtitle");


        var htmldoc = "<div class='preview-document'>" + newdocument + "</div>";

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


        jQuery("#compose .modal-title").html("Edit Notulen");
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>minutes/update/" + id);
        jQuery("input[name=title]").val(title);
        jQuery("textarea[name=description]").val(description);
        jQuery("input[name=document]").after(htmldoc);

        var agenda = jQuery(this).attr("data-agenda");
        var agendatitle = jQuery(this).attr("data-agtitle");
        
        jQuery("select[name=agenda]").val(agenda);
        jQuery("select[name=agenda]").attr("data-title", agendatitle);

        var html = '<img class="img-fit" src="' + newurl + '" />';
        jQuery('.dropify-wrapper').find('.dropify-message').before(html);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });

    $('.dropify').dropify();
</script>