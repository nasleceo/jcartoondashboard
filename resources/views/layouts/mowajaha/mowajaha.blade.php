s
@extends('app')

@section('title', 'المواجهات')

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
                            <h3> إضافة مواجهة </h3>
                            <hr>

                        </div>


                        <div class="mt-3">
                            <h6>  كيف ستكون المواجهة </h6>

                            <input required type="text" name="text" class="record-tmdb_id"
                                value="{{ old('text') }}">

                        </div>

                        <div class="mt-3">
                            <h6>  الشخصية الأولى  </h6>

                            <select name="cast_id">

                                @foreach ($allcartoons as $cartoon )
                                    <option value="{{ $cartoon->id }}">{{ $cartoon->title }}
                                    </option>
                                @endforeach

                            </select>



                        </div>


                        <div class="mt-3">
                            <h6>  الشخصية التانية  </h6>

                            <select name="cast_id_2">

                                @foreach ($allcartoons as $cartoon )
                                    <option value="{{ $cartoon->id }}">{{ $cartoon->title }}
                                    </option>
                                @endforeach

                            </select>



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

                            <button class="fetch-btn">إضافة شخصية</button>

                        </div>



                    </div>

                </div>


        </div>
        <form>



    <div class="content-table m-4 bg-white p-2">

        <table id="tvt" class="hover">
            <thead>
                <tr>
                    <th>سبب القتال</th>
                    <th>شخصية 1</th>
                    <th>شخصية 2</th>
                    <th>اعدادات</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $item)
                    <tr>


                        <td class="mytitle" >{{ $item->text }}</td>
                        <td class="warning">{{ $item->poste_cast->title }}</td>
                        <td class="warning">{{ $item->poste_cast_tani->title }}</td>

                        <td>
                            <div class="menu">
                                <i class='bx bx-dots-horizontal-rounded icon'></i>
                                <ul class="menu-link">
                                    <li><a onclick="Deletvid(event,{{ $item['id'] }})">حدف</a></li>
                                </ul>
                            </div>
                        </td>


                    </tr>
                @endforeach

            </tbody>

        </table>


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
            url: "{{ route('addmowajaha') }}",
            data: contactformData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);

                if (response == 'exit') {
                    swal({
                    title: "هناك خطأ في إضافة التقيم",
                    text: "هناك بالفعل من إستخدم هده الشخصيات في المواجهة",
                    icon: "warning",
                    buttons: false,
                    dangerMode: true,
                })
                }




                // swal({
                //     title: "تم الأمر بنجاح",
                //     text: "تم إضاقة المواجهة",
                //     icon: "success",
                //     buttons: false,
                // })

                // setTimeout(() => {
                //     window.location.replace('/mowajaha');
                // }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr.responseJSON.message);

                swal({
                    title: "هناك خطأ في إضافة التقيم",
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
                text: "ستتمكن من حدف المواجهة إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/mowajaha/delet/" + id,
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
