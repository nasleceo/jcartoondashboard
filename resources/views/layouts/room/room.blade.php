@extends('app')

@section('title', 'الغرف')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

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
                                            <h3>إضافة غرفة</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6>عنوان الغرفة</h6>


                                            <input class="nameinp" name="title" required type="text"
                                                placeholder="العنوان">


                                        </div>



                                        <div class="mt-3">
                                            <h6>نوع الغرفة</h6>


                                            <select name="type_ispublic_private">

                                                @foreach (json_decode('{"public":"عامة","private":"خاصة"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>



                                        <div class="mt-3">
                                            <h6> إختر الكرتون اللدي ستشاهده </h6>

                                            <select id="tv_id" name="tv_id">

                                                <option value="">إختر مسلسلا</option>
                                                @foreach ($allcartoons as $cartoon)
                                                    <option value="{{ $cartoon->id }}">{{ $cartoon->title }}
                                                    </option>
                                                @endforeach

                                            </select>



                                        </div>


                                        <div class="mt-3">
                                            <h6> إختر الموسم اللدي ستشاهده </h6>

                                            <select id="season_id" name="season_id">



                                            </select>



                                        </div>


                                        <div class="mt-3">
                                            <h6> إختر الحلقة </h6>

                                            <select id="epe_id" name="epe_id">



                                            </select>



                                        </div>


                                        <div class="mt-3">
                                            <h6>عدد الأشخاص المسموح بهم</h6>


                                            <input class="nameinp" name="number_limit" required type="text"
                                                placeholder="عدد الأشخاص المسموح بهم">


                                        </div>


                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">إنشاء غرفة جديدة</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>الكرتون</th>
                                            <th>الإسم</th>
                                            <th>رقم الحلقة أو الفيلم</th>
                                            <th>عدد الأشخاص</th>
                                            <th>عدد الرسائل</th>
                                            <th>نوعها</th>
                                            <th>اعدادات</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($allrooms as $item)
                                            <tr>
                                                <td><img style="width: 117px;height:171px"
                                                        src="{{ $item->cartoon->poster }}" alt=""></td>
                                                <td class="mytitle">{{ $item['title'] }}</td>
                                                <td>{{ $item->room_epe->lebel }}</td>
                                                <td class="warning">{{ count($item->room_users) }}</td>
                                                <td class="warning">{{ count($item->room_messages) }}</td>
                                                <td class="warning">{{ $item->type_ispublic_private }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                    href="/roomcartoon/messages/{{ $item['id'] }}">الرسائل</a>
                                                            </li>
                                                            <li><a
                                                                    href="/roomcartoon/user/{{ $item['id'] }}">الأشخاص</a>
                                                            </li>
                                                            <li><a
                                                                    onclick="Deletvid(event,{{ $item['id'] }})">حدف</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>


                            </div>


                            </section>





            </div>



            </main>


        </div>
    </div>



</div>








</div>




<script>
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
        var episospiner = $("#epe_id");
        var jsonObjects = {
            movieID: Movie_id
        };





        if (Movie_id != '' && Movie_id != null) {


            $.ajax({
                type: "GET",
                url: "/getMovieType/" + Movie_id,
                data: jsonObjects,
                processData: false,
                contentType: false,

                success: function(response) {

                    console.log(response);

                    if (response.includes("movie")) {

                        $.ajax({
                            type: "GET",
                            url: "/getEpisdoesMovie/" + Movie_id,
                            data: jsonObjects,
                            processData: false,
                            contentType: false,

                            success: function(response) {
                                var seasonslist = response;

                                console.log(Movie_id);
                                console.log(seasonslist);


                                episospiner.empty();
                                episospiner.append("<option value=''>إختر الحلقة</option>");

                                for (k = 0; k < seasonslist.length; k++)
                                episospiner.append("<option value='" + seasonslist[k].id +
                                        "'>" + seasonslist[k]
                                        .lebel + "</option>");



                            },
                            error: function(errr) {

                                console.log(errr);


                            }
                        });

                    } else {
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
                                    ddl.append("<option value='" + seasonslist[k].id +
                                        "'>" + seasonslist[k]
                                        .name + "</option>");

                            },
                            error: function(errr) {

                                console.log(errr);


                            }
                        });
                    }


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
