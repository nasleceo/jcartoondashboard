@extends('app')

@section('title', 'المواسم')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/seasons.css') }}">

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
                                            <h3>({{ $tv->title }}) إضافة موسم لمسلسل</h3>
                                            <hr>
                                            <div>
                                                <h6>رقم الموسم</h6>


                                                <input required type="number" name="name" class="record-tmdb_id"
                                                value="{{ old('url') }}">

                                            </div>



                                        </div>


                                        <div>
                                            <h6>الحالة</h6>


                                            <select name="status">

                                                @foreach (json_decode('{"Published":"يظهر في التطبيق","Unpublished":"لا يظهر في التطبيق"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">إضافة موسم جديد</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>رقم الموسم</th>
                                            <th>عدد الحلقات</th>
                                            <th>الحالة</th>
                                            <th>إعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($seasons as $item)
                                            <tr>
                                                <td class="mytitle">{{ $item['name'] }}</td>
                                                <td class="warning">{{ count($item->episodes) }}</td>
                                                <td class="warning">{{ $item['status'] }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                href="/tv/seasons/videos/{{ $item['id'] }}">الحلقات</a>
                                                        </li>
                                                            <li><a
                                                                    href="/tv/seasons/edit/{{ $item['id'] }}">تعديل</a>
                                                            </li>
                                                            <li>

                                                                    <div class="deletvid">
                                                                        <a onclick="Deletvid(event,{{ $item['id'] }})"
                                                                            >حدف</a>
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




<script>
    function addnewvideo(e) {
        e.preventDefault();


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('addSeason', $tv->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة موسم جديد",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/tv/seasons/' + "{{ $tv->id }}");
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
                text: "ستتمكن من حدف الموسم إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
            type: "GET",
            url: "/tv/seasons/delet/"+id,
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
