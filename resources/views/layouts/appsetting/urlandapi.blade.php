@extends('app')

@section('title', 'إعدادات')

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
                                            <h3>إعدادات </h3>
                                            <hr>




                                        </div>



                                        <div class="tab-pane active" id="rest_api" role="tabpanel">
                
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label"><strong>رابط لوحة التحكم</strong></label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <input type="text" id="api_url" name="api_secret_url"
                                                            class="form-control" required=""
                                                            value="{{env('APP_URL')}}" disabled="">
                                                        <span class="input-group-text waves-effect waves-light"
                                                            id="option-date"
                                                            onclick="copyToClipboard('api_url')">Copy</span>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label"><strong>API KEY</strong></label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <input type="text" id="api_key" name="api_secret_key"
                                                            class="form-control" required=""
                                                            value="{{env('APP_KEY')}}" disabled="">
                                                        <span class="input-group-text waves-effect waves-light"
                                                            id="option-date"
                                                            onclick="copyToClipboard('api_key')">Copy</span>
                                                        <a class="btn btn-primary" id="gsk" onclick="Generate_Secrate_Key()">
                                                            Generate New Key</a>
                                                    </div>
                                                </div>
                                            </div>

                                        <br>
                                     


                                        <div class="addmoviebtn mt-4">

                                            <button style="   height: 35px;
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
                }).then(function () {
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
            url: "{{ route('AddnewRoom') }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إنشاء الغرفة",
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
