<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Agenda</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Agenda</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <?php if ($dataAdmin->role == 'admin') { ?>
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-show-add mr-2" data-toggle="modal" data-target="#compose"><i class="fa fa-plus-square"></i> Tambah Agenda</button>
                <button class="btn btn-danger btn-sm btn-show-pdf mr-2" data-toggle="modal" data-target="#composePDF"><i class="fa fa-plus-square"></i> Upload Pdf</button>
                <button class="btn btn-primary btn-sm btn-show-word mr-2" data-toggle="modal" data-target="#composeWORD"><i class="fa fa-plus-square"></i> Upload Word</button>
                <div class="w-100 pt-3 pb-3 d-flex">
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/agenda/agenda-sample-pdf.pdf"); ?>"><i class="fa fa-file mr-1"></i>Format Pdf</a>
                    <a class="format-link small mr-4" target="_blank" href="<?= base_url("samples/agenda/agenda-sample-word.docx"); ?>"><i class="fa fa-file mr-1"></i>Format Word</a>
                </div>
            </div>
        <?php } else if ($dataAdmin->role == 'user') { ?>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th width="10%">Foto</th>
                            <th width="20%">Agenda</th>
                            <th width="15%">Date</th>
                            <th width="15%">End Date</th>
                            <th width="10%">Invitation</th>
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
                <h5 class="modal-title" id="largeModalLabel">Tambah Agenda</h5>
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
                        <label>Start Date</label>
                        <input type="text" name="startdate" autocomplete="off" class="form-control" onkeydown="return false" id="startdate">
                    </div>
                    <div class="form-group form-startdate">
                        <label>End Date</label>
                        <input type="text" name="enddate" autocomplete="off" class="form-control" onkeydown="return false" id="enddate">
                    </div>
                    <div class="form-group">
                        <label>Invitation</label>
                        <select name="invitation" autocomplete="false" class="form-control" id="invitation">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataInv as $opt) { ?>
                                <option value="<?= $opt->id; ?>" data-title="<?= $opt->title; ?>"><?= $opt->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group form-enddate">
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
                <h5 class="modal-title" id="largeModalLabel">Upload PDF Agenda</h5>
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
                        <select name="invpdf" autocomplete="false" class="form-control" id="invpdf">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataInv as $opt) { ?>
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
                <h5 class="modal-title" id="largeModalLabel">Upload Doc Agenda</h5>
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
                            <?php foreach ($dataInv as $opt) { ?>
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
    jQuery("#startdate").datepicker({
        container: '.form-startdate',
        format: "yyyy/mm/dd",
        autoclose: true,
        todayBtn: 1,
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function(selected) {
        var minDate = new Date(selected.date.valueOf());
        jQuery('#enddate').datepicker('setStartDate', minDate);
    });

    jQuery("#enddate").datepicker({
        container: '.form-enddate',
        format: "yyyy/mm/dd",
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function(selected) {
        var maxDate = new Date(selected.date.valueOf());
        jQuery('#startdate').datepicker('setEndDate', maxDate);
    });

    $(".btn-show-add").on("click", function() {
        jQuery("input[name=title]").val("");
        jQuery("input[name=document]").val("");
        jQuery("textarea[name=description]").val("");
        jQuery('.dropify-wrapper').find('.img-fit').remove();
        jQuery(".dropify").attr('data-default-file', '');
        jQuery('#startdate').val("").datepicker("update");
        jQuery('#enddate').val("").datepicker("update");
        jQuery("select[name=invitation]").val("");
        jQuery("#compose .modal-title").html("Tambah Agenda");
        jQuery("#composeForm").attr("action", "<?= base_url("agenda/insert"); ?>");
        jQuery("#composeForm").validate().resetForm();
    });

    $(".btn-show-pdf").on("click", function() {
        jQuery("input[name=filePdf]").val("");
        jQuery("input[name=document]").val("");
        jQuery("select[name=invpdf]").val("");
        jQuery("#composeFormPdf").attr("action", "<?= base_url("agenda/insert_bulk"); ?>");
        jQuery("#composeFormPdf").validate().resetForm();
        jQuery("#btn-pdf-submit").prop('disabled', true);
        titleArr = [];
        descriptionArr = [];
        tablesArr = [];
    });

    $(".btn-show-word").on("click", function() {
        jQuery("input[name=fileWord]").val("");
        jQuery("input[name=document]").val("");
        jQuery("select[name=invword]").val("");
        jQuery("#composeFormWord").attr("action", "<?= base_url("agenda/insert_bulk"); ?>");
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
        });

    };

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("agenda/json"); ?>"
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
            startdate: {
                required: true
            },
            enddate: {
                required: true
            },
            invitation: {
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
            startdate: {
                required: "*Masukkan Tanggal mulai.",
            },
            enddate: {
                required: "*Masukkan Tanggal berakhir.",
            },
            invitation: {
                required: "*Pilih Undangan.",
            }
        },
        submitHandler: function(form) {
            var form = new FormData();
            form.append("title", jQuery('input[name=title]').val());
            form.append("description", jQuery('textarea[name=description]').val());
            form.append("startdate", jQuery('input[name=startdate]').val());
            form.append("enddate", jQuery('input[name=enddate]').val());
            form.append("invitation", jQuery('select[name=invitation]').val());
            form.append("invitation_title", jQuery('select[name=invitation]').find(":selected").data('title'));
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
                        jQuery("input[name=startdate]").val("");
                        jQuery("input[name=enddate]").val("");
                        jQuery("select[name=invitation]").val("");
                        jQuery("select[name=invitation]").attr("data-title","");
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
            invpdf: {
                required: true,
            }
        },
        messages: {
            filePdf: {
                required: "*Unggah data pdf anda.",
                filesize: "*Maksimal ukuran file adalah 1MB"
            },
            invpdf: {
                required: "*Pilih Undangan.",
            }
        },
        submitHandler: function(form) {
            var title = tablesArr.map(x => x.map(a => a[0])).flat(2).filter(e => e.length);
            var description = tablesArr.map(x => x.map(a => a[1])).flat(2).filter(e => e.length);
            var startdate = tablesArr.map(x => x.map(a => a[2])).flat(2).filter(e => e.length);
            var enddate = tablesArr.map(x => x.map(a => a[3])).flat(2).filter(e => e.length);
            var inv = jQuery('select[name=invpdf]').val();
            var invtitle = jQuery('select[name=invpdf]').find(":selected").data('title');

            var count = tablesArr.map(x => x.map(a => a[0])).flat(2).length;

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("title[]", title[i]);
                form.append("description[]", description[i]);
                form.append("startdate[]", startdate[i]);
                form.append("enddate[]", enddate[i]);
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
                required: "*Pilih Undangan.",
            }
        },
        submitHandler: function(form) {

            var title = tablesArr.map(x => x.title);
            var description = tablesArr.map(x => x.description);
            var startdate = tablesArr.map(x => x.startdate);
            var enddate = tablesArr.map(x => x.enddate);
            var count = tablesArr.map(x => x.name).length;
            var invw = jQuery('select[name=invword]').val();
            var invwt = jQuery('select[name=invword]').find(":selected").data('title')

            var form = new FormData();

            for (i = 0; i < count; i++) {
                form.append("title[]", title[i]);
                form.append("description[]", description[i]);
                form.append("startdate[]", startdate[i]);
                form.append("enddate[]", enddate[i]);
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
        var title = jQuery(this).attr("data-title");
        jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + title + "</b>");
        jQuery("#delete").modal("toggle");

        jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
    })

    function deleteData(id) {
        jQuery.getJSON("<?= base_url(); ?>agenda/delete/" + id, function(data) {
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
        var startdate = jQuery(this).attr("data-startdate");
        var enddate = jQuery(this).attr("data-enddate");
        var photo = jQuery(this).attr("data-photo");
        var document = jQuery(this).attr("data-document");
        var newdocument = document.substring(document.lastIndexOf("/") + 1);

        var invitation = jQuery(this).attr("data-invitation");
        var invitationtitle = jQuery(this).attr("data-invtitle");

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
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>agenda/update/" + id);
        jQuery("input[name=title]").val(title);
        jQuery("textarea[name=description]").val(description);
        jQuery("input[name=startdate]").val(startdate);
        jQuery("input[name=enddate]").val(enddate);
        jQuery("input[name=document]").after(htmldoc);

        jQuery("select[name=invitation]").val(invitation);
        jQuery("select[name=invitation]").attr("data-title",invitationtitle);

        jQuery('#startdate').datepicker('setDate', startdate);

        jQuery('#enddate').datepicker('setDate', enddate);

        var html = '<img class="img-fit" src="' + newurl + '" />';
        jQuery('.dropify-wrapper').find('.dropify-message').before(html);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });

    $('.dropify').dropify();
</script>