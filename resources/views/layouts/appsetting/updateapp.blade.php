@extends('app')

@section('title', 'تحديث التطبيق')

@section('contant')

@section('scripte')



@endsection



<div class="create-movie card m-4">





    <div class="importdata">



        <div class="meddle">
            <div class="container-movies-2">
                <main>

                    <form id="addnewtvform" enctype="multipart/form-data" onsubmit="addnewvideo(event)" method="POST">
                        @csrf

                        <div class="all-movies">


                            <section class="movie-section">


                                <div class="king-info">

                                    <div class="fetch">
                                        <div class="Movie-Info">
                                            <h3>تحديث التطبيق </h3>
                                            <hr>




                                        </div>


                                        <div class="panel-body">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong>التحديث سيضهر لأصحاب النسخ القديمة
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label">Update Type</label>
                                                <div class="col-sm-3 ">
                                                    <select class="form-control form-select" id="Update_Type"
                                                        name="Update_Type">
                                                        <option value="0">In App Update</option>
                                                        <option value="1">External Browser</option>
                                                        <option value="2">Google Play In App Update
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="GooglePlay_Update_Type_form">
                                                <label class="col-sm-3 control-label">Googleplay App Update
                                                    Type</label>
                                                <div class="col-sm-3 ">
                                                    <select class="form-control form-select"
                                                        id="GooglePlay_Update_Type"
                                                        name="GooglePlay_Update_Type">
                                                        <option value="0">Flexible</option>
                                                        <option value="1">Immediate</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">Latest APK Version
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="" name="apk_version_name"
                                                        id="apk_version_name" placeholder="Ex: V1.0.0"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">Latest APK Version
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <input type="number" value="" name="apk_version_code"
                                                        id="apk_version_code" placeholder="Ex: 0"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="latest_apk_url_form">
                                                <label class="control-label col-sm-3 ">APK File URL</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="" name="latest_apk_url"
                                                        id="latest_apk_url"
                                                        placeholder="Ex: PlayStore URL or any other direct download URL"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="apk_whats_new_form">
                                                <label class="col-sm-3 control-label">What's new on latest
                                                    APK</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" rows="6" name="apk_whats_new" id="apk_whats_new" class="form-control"></textarea>
                                                    <p><small>Separate Line By Comma ( , ).</small></p>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3" id="update_skipable_form">
                                                <label class="control-label col-sm-3 ">Update Skipable?</label>
                                                <div class="col-sm-6">
                                                    <input type="checkbox" id="update_skipable"
                                                        name="update_skipable" switch="bool">
                                                    <label for="update_skipable" data-on-label=""
                                                        data-off-label=""></label>
                                                </div>
                                            </div>



                                        </div>










                                        <div class="addmoviebtn mt-4">

                                            <button
                                                style="   height: 35px;
                                            border: 1px solid var(--color-primary);
                                            background: var(--color-primary);
                                            border-radius: 3px;
                                            width: 100%;
                                            color: var(--color-white);
                                            margin-right: .8rem;
                                            padding: 0rem .5rem;
                                            cursor: pointer;">حفظ</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>



                            </section>





            </div>



            </main>


        </div>
    </div>



</div>








</div>




<script>


            $('#apk_version_name').val('{{ $update->Latest_APK_Version_Name ?? null }}');
            $('#apk_version_code').val('{{ $update->Latest_APK_Version_Code ?? null }}');
            $('#latest_apk_url').val('{{ $update->APK_File_URL ?? null }}');
            $('#apk_whats_new').val('{{ $update->Whats_new_on_latest_APK ?? null }}');
			$('#Update_Type').val('{{ $update->Update_Type ?? null }}');
			$('#GooglePlay_Update_Type').val('{{ $update->googleplayAppUpdateType ?? null }}');

			if ('{{ $update->Update_Skipable ?? 1 }}' == 1) {
                document.getElementById("update_skipable").checked = true;
            } else {
                document.getElementById("update_skipable").checked = false;
            }



			if(document.getElementById("Update_Type").value == 0 || document.getElementById("Update_Type").value == 1) {
				$("#GooglePlay_Update_Type_form").hide();

				$("#apk_version_name_form").show();
				$("#apk_version_code_form").show();
				$("#latest_apk_url_form").show();
				$("#apk_whats_new_form").show();
				$("#update_skipable_form").show();
			  } else if(document.getElementById("Update_Type").value == 2) {
				$("#GooglePlay_Update_Type_form").show();

				$("#apk_version_name_form").hide();
				$("#apk_version_code_form").hide();
				$("#latest_apk_url_form").hide();
				$("#apk_whats_new_form").hide();
				$("#update_skipable_form").hide();
			  }
			document.getElementById("Update_Type").addEventListener('change', function() {
              if(this.value == 0 || this.value == 1) {
				$("#GooglePlay_Update_Type_form").hide();

				$("#apk_version_name_form").show();
				$("#apk_version_code_form").show();
				$("#latest_apk_url_form").show();
				$("#apk_whats_new_form").show();
				$("#update_skipable_form").show();
			  } else if(this.value == 2) {
				$("#GooglePlay_Update_Type_form").show();

				$("#apk_version_name_form").hide();
				$("#apk_version_code_form").hide();
				$("#latest_apk_url_form").hide();
				$("#apk_whats_new_form").hide();
				$("#update_skipable_form").hide();
			  }
            }, false);


    function copyToClipboard(element) {
        document.getElementById(element).disabled = false;
        var copyText = document.getElementById(element);
        copyText.focus();
        copyText.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            swal.fire({
                title: 'Copied!',
                html: copyText.value + '<br>Now just paste into android configuration file',
                icon: 'success'
            });
        } catch (err) {
            swal.fire({
                title: 'Error',
                text: 'Something Went Wrong :(',
                icon: 'error'
            }).then(function() {
                location.reload();
            });
        }
        document.getElementById(element).disabled = true;
    }


    function addnewvideo(e) {
        e.preventDefault();


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('saveupdate') }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                console.log(response);
                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم حفظ التحديث",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.reload();
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr);
                swal({
                    title: "هناك خطأ",
                    text: errr.responseJSON.message,
                    icon: "warning",
                    buttons: false,
                    dangerMode: true,
                })
            }
        });

    }

    function Deletvid(e, id) {
        e.preventDefault();


        console.log(id);

        swal({
                title: "هل انت متأكد",
                text: "ستتمكن من حدف الغرفة إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/roomcartoon/delete/" + id,
                        processData: false,
                        contentType: false,
                        success: function(response) {


                            swal("تم الحدف بنجاح", {
                                icon: "success",
                            });

                            setTimeout(() => {
                                window.location.reload();
                            }, 1200);


                            //


                        },
                        error: function(errr) {

                            console.log(errr);

                        }
                    });





                } else {
                    swal("تم إلغاء الحدف");
                }
            });



    }


    $("#tv_id").change(function() {
        var Movie_id = $("#tv_id option:selected").val();
        var ddl = $("#season_id");
        var jsonObjects = {
            movieID: Movie_id
        };


        if (Movie_id != '' && Movie_id != null) {

            $.ajax({
                type: "GET",
                url: "/getSeasons/" + Movie_id,
                data: jsonObjects,
                processData: false,
                contentType: false,

                success: function(response) {
                    var seasonslist = response;

                    console.log(seasonslist.length);
                    ddl.empty();
                    ddl.append("<option value=''>إختر الموسم</option>");
                    for (k = 0; k < seasonslist.length; k++)
                        ddl.append("<option value='" + seasonslist[k].id + "'>" + seasonslist[k]
                            .name + "</option>");

                },
                error: function(errr) {

                    console.log(errr);


                }
            });



        } else {
            console.log('kika');
        }

    });

    $("#season_id").change(function() {
        var Movie_id = $("#season_id option:selected").val();
        var ddl = $("#epe_id");
        var jsonObjects = {
            movieID: Movie_id
        };


        if (Movie_id != '' && Movie_id != null) {

            $.ajax({
                type: "GET",
                url: "/getEpisdoes/" + Movie_id,
                data: jsonObjects,
                processData: false,
                contentType: false,

                success: function(response) {
                    var seasonslist = response;

                    console.log(seasonslist);


                    ddl.empty();
                    ddl.append("<option value=''>إختر الحلقة</option>");

                    for (k = 0; k < seasonslist.length; k++)
                        ddl.append("<option value='" + seasonslist[k].id + "'>" + seasonslist[k]
                            .lebel + "</option>");



                },
                error: function(errr) {

                    console.log(errr);


                }
            });



        } else {
            console.log('kika');
        }

    });

    const allMenu = document.querySelectorAll('.menu');

    allMenu.forEach(item => {
        const icon = item.querySelector('.icon');
        const menuLink = item.querySelector('.menu-link');

        icon.addEventListener('click', function() {
            menuLink.classList.toggle('show');
        })
    })



    window.addEventListener('click', function(e) {


        allMenu.forEach(item => {
            const icon = item.querySelector('.icon');
            const menuLink = item.querySelector('.menu-link');

            if (e.target !== icon) {
                if (e.target !== menuLink) {
                    if (menuLink.classList.contains('show')) {
                        menuLink.classList.remove('show')
                    }
                }
            }
        })
    })

    $(document).ready(function() {
        $('#tvt').DataTable({
            searching: false,
            paging: false,
            info: false
        });





    });
</script>




@endsection
