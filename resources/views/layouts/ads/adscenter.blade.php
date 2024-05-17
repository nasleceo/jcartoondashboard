@extends('app')

@section('title', 'مركز الإعلانات')

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
                                            <h3>مركز الإعلانات</h3>
                                            <hr>




                                        </div>


                                        <div class="panel-body">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين أول مايدخلو للتطبيق
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_dialog_ads" id="link_dialog_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_dialog_ads" id="image_dialog_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_dialog_ads" id="end_date_dialog_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>



                                        </div>
                                        <div class="panel-body mt-5">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين في الصفحة الريئسية علي شكل بانر
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_home_banner_ads" id="link_home_banner_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_home_banner_ads" id="image_home_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_home_banner_ads" id="end_date_home_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>



                                        </div>
                                        <div class="panel-body mt-5">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين في صفحة معلومات عن الكرتون علي شكل بانر
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_episodes_banner_ads" id="link_episodes_banner_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_episodes_banner_ads" id="image_episodes_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_episodes_banner_ads" id="end_date_episodes_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>



                                        </div>
                                        <div class="panel-body mt-5">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين في صفحة البحث علي شكل بانر
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_search_banner_ads" id="link_search_banner_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_search_banner_ads" id="image_search_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_search_banner_ads" id="end_date_search_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>



                                        </div>
                                        <div class="panel-body mt-5">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين في  مشغل الفيديو علي شكل بانر
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_player_banner_ads" id="link_player_banner_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_player_banner_ads" id="image_player_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_player_banner_ads" id="end_date_player_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>



                                        </div>
                                        <div class="panel-body mt-5">
                                            <!-- panel  -->
                                            <div class="alert alert-success"><strong>تنبيه </strong> الإعلان يطهر
                                                للمستخدمين في  قراءة الكوميكس علي شكل بانر
                                            </div>



                                            <div class="form-group block"
                                                style="
                                            width: 100%;
                                            display: block;
                                            padding-top: 24px;"
                                                id="apk_version_name_form">
                                                <label class="col-sm-3 control-label">رابط الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="link_comics_banner_ads" id="link_comics_banner_ads"
                                                        placeholder="Ex: V1.0.0" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">صورة الإعلان</label>
                                                <div>
                                                    <input class="mt-3" type="text" value=""
                                                        name="image_comics_banner_ads" id="image_comics_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group mt-3"
                                                style="
                                            width: 100%;
                                            display: block;"
                                                id="apk_version_code_form">
                                                <label class="col-sm-3 control-label">تاريخ الإنتهاء</label>
                                                <div>
                                                    <input class="mt-3" type="date" value=""
                                                        name="end_date_comics_banner_ads" id="end_date_comics_banner_ads"
                                                        placeholder="Ex: 0" class="form-control">
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
    $('#link_dialog_ads').val('{{ $update->link_dialog_ads ?? null }}');
    $('#image_dialog_ads').val('{{ $update->image_dialog_ads ?? null }}');
    $('#end_date_dialog_ads').val('{{ $update->end_date_dialog_ads ?? null }}');



    $('#link_home_banner_ads').val('{{ $update->link_home_banner_ads ?? null }}');
    $('#image_home_banner_ads').val('{{ $update->image_home_banner_ads ?? null }}');
    $('#end_date_home_banner_ads').val('{{ $update->end_date_home_banner_ads ?? null }}');



    $('#link_episodes_banner_ads').val('{{ $update->link_episodes_banner_ads ?? null }}');
    $('#image_episodes_banner_ads').val('{{ $update->image_episodes_banner_ads ?? null }}');
    $('#end_date_episodes_banner_ads').val('{{ $update->end_date_episodes_banner_ads ?? null }}');



    $('#link_search_banner_ads').val('{{ $update->link_search_banner_ads ?? null }}');
    $('#image_search_banner_ads').val('{{ $update->image_search_banner_ads ?? null }}');
    $('#end_date_search_banner_ads').val('{{ $update->end_date_search_banner_ads ?? null }}');


    $('#link_player_banner_ads').val('{{ $update->link_player_banner_ads ?? null }}');
    $('#image_player_banner_ads').val('{{ $update->image_player_banner_ads ?? null }}');
    $('#end_date_player_banner_ads').val('{{ $update->end_date_player_banner_ads ?? null }}');



    $('#link_comics_banner_ads').val('{{ $update->link_comics_banner_ads ?? null }}');
    $('#image_comics_banner_ads').val('{{ $update->image_comics_banner_ads ?? null }}');
    $('#end_date_comics_banner_ads').val('{{ $update->end_date_comics_banner_ads ?? null }}');



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
            url: "{{ route('saveadsCenter') }}",
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
