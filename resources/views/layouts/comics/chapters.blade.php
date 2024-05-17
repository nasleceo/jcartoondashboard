@extends('app')

@section('title', 'الفصول')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

@endsection



<div class="create-movie card m-4">

    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <h4 class="textsucc">{{ $error }}</h4>
            @endforeach
        </div>

    @endif




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
                                            <h3>({{ $comic->title }}) إضافة فصل للكوميكس</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6>رقم الفصل</h6>

                                            <input required type="number" name="title" class="record-tmdb_id"
                                                value="{{ old('title') }}">

                                        </div>

                                        <div class="mt-3">
                                            <h6>رابط التحميل </h6>

                                            <input required type="text" name="direct_link" class="record-tmdb_id"
                                                value="{{ old('direct_link') }}">

                                        </div>


                                        <div class="mt-3">
                                            <h6>
                                                <p>( يسمح فقط بملف zip )</p> إرفع الفصل علي شكل ملف مضغوط
                                            </h6>

                                            <input required type="file" name="chapters_folder_link"
                                                class="record-tmdb_id" value="{{ old('chapters_folder_link') }}">
                                            <i class="fas fa-cloud-upload-alt"></i>

                                            <div>
                                                <div class="percent"></div>
                                            </div>

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

                                            <button class="rafachapter fetch-btn">إضافة الفصل</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                            <th>رقم الفصل</th>
                                            <th>رابط التحميل</th>
                                            <th>عدد الصفحات</th>
                                            <th>إعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($chapters as $item)
                                            <tr>
                                                <td>
                                                    <div class="warning">{{ $item['id'] }}</div>
                                                </td>
                                                <td>
                                                    <div class="warning">{{ $item['title'] }}</div>
                                                </td>
                                                <td class="urldialchapter">{{ $item['direct_link'] }}</td>
                                                <td class="warning">{{ count($item->images) }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                    href="/comic/chapters/edit/{{ $item['id'] }}">تعديل</a>
                                                            </li>
                                                            <li>

                                                                <div class="deletvid">
                                                                    <a
                                                                        onclick="Deletvid(event,{{ $item['id'] }})">حدف</a>
                                                                </div>




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


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
    integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
</script>




<script>
    function addnewvideo(e) {
        e.preventDefault();


        var percent = $('.percent');
        var rafachapter = $('.rafachapter');


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('addchapter', $comic->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            beforeSend: function() {

                var percentVal = '....يرجى الإنتضار قليلا حتي يتم رفع الفصل';
                rafachapter.attr('disabled', true);
                rafachapter.html(percentVal);


            },
            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة الفصل",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/comic/chapters/' + "{{ $comic->id }}");
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr.responseJSON.message);

                swal({
                    title: "هناك خطأ في إضافة الفصل",
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
                text: "ستتمكن من حدف الفصل إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/comic/chapters/delet/" + id,
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
