@extends('app')

@section('title', 'المستخدمين في الغرفة')

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
                                            <h3>إضافة مستخدم</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6>المستخدم</h6>


                                            <input class="nameinp" name="user_id" required type="number" placeholder="المستخدم">


                                        </div>


                                        <div class="mt-3">
                                            <h6>رمز الغرفة</h6>


                                            <input class="nameinp" name="invitaion_code" required type="text" placeholder="رمز الغرفة">


                                        </div>




                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">إضافة المستخدم للغرفة</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>الغرفة</th>
                                            <th>الإسم</th>
                                            <th>الإيميل</th>
                                            <th>رمز الغرفة</th>
                                            <th>اعدادات</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($usersinroom as $item)
                                            <tr>

                                                <td>{{ $item->room->title }}</td>
                                                <td class="warning">{{ $item->user->name }}</td>
                                                <td class="warning">{{ $item->user->email  }}</td>
                                                <td class="warning">{{ $item->invitaion_code }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                    onclick="Deletvid(event,{{ $item['id'] }})">خروج</a>
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
            url: "{{ route('AddnewUserToRoom',$room->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {

                if (response == 'رمز الدعوة غير صحيح') {
                    swal({
                    title: "هناك خطأ",
                    text: 'رمز الدعوة غير صحيح',
                    icon: "warning",
                    buttons: false,
                    dangerMode: true,
                })


                }
                else{
                    swal({
                    title: response,
                    text: "تم  إضافة المستخدم",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.reload();
                }, 1200);

                }

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
                text: "ستتمكن من حدف المستخدم إدا ضغطت علي زر حدف",
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
