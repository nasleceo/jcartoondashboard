@extends('app')

@section('title', 'المراجعات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

@endsection

<div class="ads">
    <div class="wrapper">

        <a href="#" class=" mt-3" style="display: flex;
        justify-content: center">المنشورات التي تحتاج موافقة
            ({{ count($posts_unaproved) }})</a>
    </div>
</div>
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
                                            <h3>إضافة مراجعة</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6> الكود الخاص بالكرتون أو الكوميكس المرتبط بالمراجعة</h6>

                                            <input type="text" name="tv_id" class="record-tmdb_id"
                                                value="{{ old('tv_id') }}">

                                        </div>


                                        <div class="mt-3">
                                            <h6>أكتب المنشور</h6>

                                            <textarea class="record-tmdb_id" name="text" required id="text-desc" rows="5"></textarea>

                                        </div>


                                        <div class="mt-3">
                                            <h6>الحالة</h6>


                                            <select name="status">

                                                @foreach (json_decode('{"Published":"يظهر في التطبيق","Unpublished":"لا يظهر في التطبيق"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="addmoviebtn mt-4">

                                            <button class="rafachapter fetch-btn">إضافة مراجعة</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>



                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الكرتون</th>
                                            <th>الإسم</th>
                                            <th>المراجعة</th>
                                            <th>الحالة</th>
                                            <th>عدد تعلي</th>
                                            <th>عدد الجيجي</th>
                                            <th>المشاهدات</th>
                                            <th>اعدادات</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($posts as $item)
                                            <tr>
                                                <td>{{ $item['id'] }}</td>

                                                <td class="mytitle">{{ $item->poste_cartoon->title }}</td>
                                                <td class="mytitle">{{ $item->poste_user->name }}</td>
                                                <td>{{ $item['text'] }}</td>
                                                <td class="warning">{{ $item->state }}</td>
                                                <td class="warning">{{ count($item->poste_comments) }}</td>
                                                <td class="warning">{{ $item->totalLikers }}</td>
                                                <td class="warning">{{ $item->visit_count_total }}</td>

                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">

                                                            <li><a href="nadariat/edit/{{ $item['id'] }}">تعديل</a>
                                                            </li>
                                                            <li><a
                                                                    href="posts/comments/{{ $item['id'] }}">التعليقات</a>
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







<script>
    function addnewvideo(e) {
        e.preventDefault();


        var percent = $('.percent');
        var rafachapter = $('.rafachapter');


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('reviews.post') }}",
            data: contactformData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة المنشور",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/reviews');
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr.responseJSON.message);

                swal({
                    title: "هناك خطأ في إضافة المنشور",
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
                text: "ستتمكن من حدف المنشور إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/reviews/delet/" + id,
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
                            swal({
                                title: "هناك خطأ",
                                text: errr.responseJSON.message,
                                icon: "warning",
                                buttons: false,
                                dangerMode: true,
                            })
                        }
                    });





                } else {
                    swal("تم إلغاء الحدف");
                }
            });



    }




    // MENU
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
        $('#tvt').DataTable();



    });
</script>


@endsection
